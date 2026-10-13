#!/usr/bin/env bash
# Restore drill ONLY against a dedicated, empty local PostgreSQL test database.
# Never accepts a production-shaped connection or deletes an existing database.
set -euo pipefail
umask 077
die() { echo "[restore-test] $*" >&2; exit 1; }
[[ $# -eq 1 ]] || die 'Uso: verify-restore.sh BACKUP_SET_DIR'
set_dir=$(realpath -e -- "$1")
[[ -f "$set_dir/.complete" && -f "$set_dir/database.dump" && -f "$set_dir/storage.tar.gz" && -f "$set_dir/SHA256SUMS" ]] \
    || die 'Conjunto de backup incompleto.'
[[ "${RESTORE_HOST:-}" == 127.0.0.1 && "${RESTORE_PORT:-}" == 55432 \
    && "${RESTORE_DB:-}" =~ ^isp_bie_restore_[a-z0-9_]+$ && "${RESTORE_USER:-}" == isp_bie_test ]] \
    || die 'Ligação não isolada recusada.'
for tool in psql pg_restore tar sha256sum mktemp; do command -v "$tool" >/dev/null || die "Falta $tool"; done
(cd "$set_dir" && sha256sum -c SHA256SUMS)
pg_restore --list "$set_dir/database.dump" >/dev/null
while IFS= read -r entry; do
    [[ "$entry" == ./* && "$entry" != *'../'* && "$entry" != *'/..' ]] || die 'Entrada insegura no arquivo.'
done < <(tar -tzf "$set_dir/storage.tar.gz")
tmp=$(mktemp -d)
trap 'rm -rf -- "$tmp"' EXIT
tar -xzf "$set_dir/storage.tar.gz" -C "$tmp" --no-same-owner --no-same-permissions

export PGHOST="$RESTORE_HOST" PGPORT="$RESTORE_PORT" PGDATABASE="$RESTORE_DB" PGUSER="$RESTORE_USER"
export PGPASSWORD="${RESTORE_DB_PASSWORD:-}"
identity=$(psql -X -At -v ON_ERROR_STOP=1 -c 'SELECT current_database() || chr(124) || current_user')
[[ "$identity" == "$RESTORE_DB|$RESTORE_USER" ]] || die 'Identidade da base divergente.'
tables=$(psql -X -At -v ON_ERROR_STOP=1 -c "SELECT count(*) FROM pg_tables WHERE schemaname='public'")
[[ "$tables" == 0 ]] || die 'Base de restauro tem tabelas; preparar uma base nova e vazia.'
pg_restore --exit-on-error --no-owner --no-acl -d "$RESTORE_DB" "$set_dir/database.dump"

missing=0
count=0
while IFS= read -r path; do
    [[ "$path" == alumni-documentos/* && "$path" != *'..'* && "$path" != *'\\'* ]] || die 'Caminho alumni inválido na base restaurada.'
    if [[ ! -f "$tmp/public/$path" && ! -f "$tmp/private/alumni/$path" ]]; then
        missing=$((missing + 1))
    fi
    count=$((count + 1))
done < <(psql -X -At -v ON_ERROR_STOP=1 -c 'SELECT ficheiro FROM alumni_documentos ORDER BY id')
[[ "$missing" == 0 ]] || die "$missing de $count documentos alumni ausentes do arquivo."
echo "[restore-test] Restauro isolado concluído; $count referências alumni verificadas."
