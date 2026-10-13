#!/usr/bin/env bash
# Production backup. Fails closed: no database, live storage, or verified
# offsite copy means no completed backup. Never reads or copies .env.
set -euo pipefail
umask 077

die() { printf '[backup] ERRO: %s\n' "$*" >&2; exit 1; }
require() { command -v "$1" >/dev/null 2>&1 || die "Ferramenta em falta: $1"; }
absolute() { [[ "$1" == /* && "$1" != *'/../'* && "$1" != */.. && "$1" != *'/./'* ]]; }

for name in APP_DIR STORAGE_DIR BACKUP_DIR DB_HOST DB_PORT DB_DATABASE DB_USERNAME DB_PASSWORD; do
    [[ -n "${!name:-}" ]] || die "Variável obrigatória ausente: $name"
done
[[ "${DB_CONNECTION:-}" == pgsql ]] || die 'Este backup exige DB_CONNECTION=pgsql.'
[[ "$DB_PORT" =~ ^[0-9]{1,5}$ ]] || die 'DB_PORT inválido.'
for path in "$APP_DIR" "$STORAGE_DIR" "$BACKUP_DIR"; do
    absolute "$path" || die 'Todos os caminhos devem ser absolutos e sem traversal.'
done
for tool in realpath pg_dump pg_restore tar sha256sum flock mktemp; do require "$tool"; done

app_root=$(realpath -e -- "$APP_DIR")
storage_root=$(realpath -e -- "$STORAGE_DIR")
[[ -f "$app_root/artisan" && -d "$storage_root/public" ]] || die 'Instalação ou storage público real não encontrado.'
[[ "$(realpath -e -- "$app_root/storage/app")" == "$storage_root" ]] || die 'STORAGE_DIR não coincide com o storage da aplicação.'
links=$(find "$storage_root" -type l -print -quit) || die 'Não foi possível inspecionar o storage.'
[[ -z "$links" ]] || die 'Storage contém links simbólicos; inventariar antes do backup.'

install -d -m 700 -- "$BACKUP_DIR"
backup_root=$(realpath -e -- "$BACKUP_DIR")
[[ "$backup_root" != "$app_root" && "$backup_root" != "$storage_root" ]] || die 'Destino de backup coincide com a origem.'
case "$backup_root/" in "$app_root/"*|"$storage_root/"*) die 'Destino de backup dentro da origem.';; esac
exec 9>"$backup_root/.backup.lock"
flock -n 9 || die 'Já existe um backup em execução.'

id="backup-$(date -u +%Y%m%dT%H%M%SZ)-$$"
work=$(mktemp -d "$backup_root/.incomplete.XXXXXXXX")
bundle="$backup_root/.upload-$id.tar.gz"
download="$backup_root/.download-$id.tar.gz"
cleanup() { if [[ -n "$work" ]]; then rm -rf -- "$work"; fi; rm -f -- "$bundle" "$download"; }
trap cleanup EXIT

printf '[backup] Criar dump PostgreSQL e arquivo do storage real: %s\n' "$id"
PGPASSWORD="$DB_PASSWORD" pg_dump -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USERNAME" \
    -d "$DB_DATABASE" -Fc -f "$work/database.dump"
[[ -s "$work/database.dump" ]] || die 'Dump vazio.'
pg_restore --list "$work/database.dump" >/dev/null || die 'Dump PostgreSQL inválido.'

tar -C "$storage_root" -czf "$work/storage.tar.gz" .
[[ -s "$work/storage.tar.gz" ]] || die 'Arquivo de documentos vazio.'
tar -tzf "$work/storage.tar.gz" >/dev/null || die 'Arquivo de documentos inválido.'
(
    cd "$work"
    sha256sum database.dump storage.tar.gz > SHA256SUMS
    sha256sum -c SHA256SUMS >/dev/null
)
printf 'id=%s\ncreated_utc=%s\napp=%s\nstorage=%s\ndatabase=%s\n' \
    "$id" "$(date -u +%FT%TZ)" "$app_root" "$storage_root" "$DB_DATABASE" > "$work/manifest.txt"

[[ "${REQUIRE_OFFSITE:-1}" == 1 ]] || die 'Backup sem cópia externa recusado neste workflow.'
[[ -n "${BACKUP_S3_BUCKET:-}" ]] || die 'BACKUP_S3_BUCKET ausente; backup incompleto.'
[[ "$BACKUP_S3_BUCKET" =~ ^[a-z0-9][a-z0-9.-]{1,61}[a-z0-9]$ ]] || die 'Nome do bucket inválido.'
prefix="${BACKUP_S3_PREFIX:-isp-bie}"
[[ "$prefix" =~ ^[A-Za-z0-9/_-]+$ && "$prefix" != /* && "$prefix" != *'..'* ]] || die 'Prefixo S3 inválido.'
require aws
tar -C "$work" -czf "$bundle" database.dump storage.tar.gz SHA256SUMS manifest.txt
local_hash=$(sha256sum "$bundle" | cut -d ' ' -f 1)
remote="s3://$BACKUP_S3_BUCKET/${prefix%/}/$id.tar.gz"
aws s3 cp "$bundle" "$remote" --sse AES256 --only-show-errors
aws s3 cp "$remote" "$download" --only-show-errors
[[ "$(sha256sum "$download" | cut -d ' ' -f 1)" == "$local_hash" ]] || die 'Cópia externa divergente.'

printf '%s  %s\n' "$local_hash" "$id.tar.gz" > "$work/REMOTE_SHA256"
printf 'verified_offsite=%s\n' "$remote" >> "$work/manifest.txt"
touch "$work/.complete"
mv -- "$work" "$backup_root/$id"
work=''
printf '[backup] Concluído e verificado: %s\n' "$id"
# Retenção automática permanece desligada até existir um ensaio de restauro
# aprovado. Falhas nunca eliminam backups anteriores.
