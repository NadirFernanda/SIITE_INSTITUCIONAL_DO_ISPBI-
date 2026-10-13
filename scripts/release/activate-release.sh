#!/usr/bin/env bash
# Runs on the server only after an approved, authenticated SSH invocation.
# Usage: publish ARCHIVE SHA HASH CHANGE ROOT SHARED CURRENT HEALTH
#        rollback SHA CHANGE ROOT SHARED CURRENT HEALTH
set -euo pipefail
umask 077
die() { echo "[activate] $*" >&2; exit 1; }
safe_path() { [[ "$1" =~ ^/[A-Za-z0-9._/-]+$ && "$1" != *'..'* && "$1" != */ ]]; }
safe_sha() { [[ "$1" =~ ^[0-9a-f]{40}$ ]]; }
safe_change() { [[ "$1" =~ ^[A-Za-z0-9._-]{3,80}$ ]]; }

mode="${1:-}"
if [[ "$mode" == publish ]]; then
    [[ $# -eq 9 ]] || die 'Argumentos de publicação inválidos.'
    archive="$2"; sha="$3"; expected="$4"; change="$5"
    root="$6"; shared="$7"; current="$8"; health="$9"
    [[ "$expected" =~ ^[0-9a-f]{64}$ ]] || die 'Hash inválido.'
elif [[ "$mode" == rollback ]]; then
    [[ $# -eq 7 ]] || die 'Argumentos de rollback inválidos.'
    sha="$2"; change="$3"; root="$4"; shared="$5"; current="$6"; health="$7"
else
    die 'Operação inválida.'
fi
safe_sha "$sha" && safe_change "$change" || die 'SHA ou identificador inválido.'
for path in "$root" "$shared" "$current"; do safe_path "$path" || die 'Caminho inválido.'; done
[[ "$root" != "$current" && "$shared" != "$current" && "$root" != "$shared" ]] || die 'Caminhos de release sobrepostos.'
[[ "$health" =~ ^https?://[A-Za-z0-9.-]+(:[0-9]{1,5})?(/[A-Za-z0-9/_-]*)?$ ]] || die 'Health URL inválido.'
[[ -d "$root/releases" && -d "$shared/storage/app/public" && -f "$shared/.env" ]] || die 'Estrutura de releases/shared incompleta.'
root=$(realpath -e -- "$root")
shared=$(realpath -e -- "$shared")
[[ -L "$current" ]] || die 'CURRENT_LINK tem de ser um link; a instalação antiga não será substituída.'
previous=$(realpath -e -- "$current")
case "$previous/" in "$root/releases/"*) ;; *) die 'Release actual fora do directório aprovado.';; esac
[[ -f "$previous/RELEASE_SHA" ]] || die 'Release actual sem marcador; cutover não autorizado.'

target="$root/releases/$sha"
stage=''
cleanup() { if [[ -n "$stage" && -d "$stage" ]]; then rm -rf -- "$stage"; fi; }
trap cleanup EXIT
if [[ "$mode" == publish ]]; then
    safe_path "$archive" || die 'Caminho do artefacto inválido.'
    [[ -f "$archive" && ! -L "$archive" ]] || die 'Artefacto ausente ou link.'
    archive=$(realpath -e -- "$archive")
    case "$archive" in "$root/incoming/"*) ;; *) die 'Artefacto fora da área de entrada.';; esac
    [[ "$(sha256sum "$archive" | cut -d ' ' -f 1)" == "$expected" ]] || die 'Artefacto divergente.'
    # GNU tar lists the archive before extraction. Reject paths and links.
    while IFS= read -r entry; do
        [[ "$entry" == ./* && "$entry" != *'../'* && "$entry" != *'/..' ]] || die 'Entrada de tar insegura.'
    done < <(tar -tzf "$archive")
    if tar -tvzf "$archive" | awk 'substr($1,1,1)=="l" || substr($1,1,1)=="h" {bad=1} END {exit !bad}'; then
        die 'Links no artefacto.'
    fi
    if [[ -e "$target" ]]; then
        [[ -d "$target" && ! -L "$target" && -f "$target/.artifact_sha256" \
            && "$(cat "$target/.artifact_sha256")" == "$expected" ]] || die 'Release existente em conflito.'
    else
        stage=$(mktemp -d "$root/releases/.pending.XXXXXXXX")
        tar -xzf "$archive" -C "$stage" --no-same-owner --no-same-permissions
        # mktemp/umask keep staging private; published code must be traversable
        # by PHP-FPM and Nginx. Shared secrets keep their own restricted modes.
        find "$stage" -type d -exec chmod 0755 {} +
        find "$stage" -type f -exec chmod 0644 {} +
        [[ "$(cat "$stage/RELEASE_SHA")" == "$sha" && -f "$stage/vendor/autoload.php" && -f "$stage/public/build/manifest.json" ]] \
            || die 'Conteúdo do artefacto inválido.'
        [[ ! -e "$stage/.env" && ! -e "$stage/storage" && ! -e "$stage/public/storage" ]] || die 'Artefacto contém dados partilhados.'
        ln -s "$shared/.env" "$stage/.env"
        ln -s "$shared/storage" "$stage/storage"
        ln -s "$shared/storage/app/public" "$stage/public/storage"
        mkdir -p "$stage/bootstrap/cache"
        (cd "$stage" && php -l public/index.php >/dev/null)
        printf '%s\n' "$expected" > "$stage/.artifact_sha256"
        mv -- "$stage" "$target"
        stage=''
    fi
else
    [[ -d "$target" && ! -L "$target" && -f "$target/.artifact_sha256" ]] || die 'Release de rollback inexistente.'
fi
[[ "$(cat "$target/RELEASE_SHA")" == "$sha" ]] || die 'SHA da release divergente.'
sudo nginx -t >/dev/null

switch_to() {
    local destination="$1" temporary="${current}.next.$$"
    [[ ! -e "$temporary" && ! -L "$temporary" ]] || die 'Link temporário já existe.'
    ln -s "$destination" "$temporary"
    mv -Tf -- "$temporary" "$current"
}
switch_to "$target"
if ! sudo systemctl reload php8.4-fpm || ! curl --fail --silent --show-error --max-time 15 "$health" >/dev/null; then
    echo '[activate] Health check falhou; repor release anterior.' >&2
    switch_to "$previous"
    sudo systemctl reload php8.4-fpm || true
    die 'Publicação revertida. Verificar saúde da release anterior.'
fi
printf '[activate] %s concluído: %s (mudança %s); anterior %s\n' "$mode" "$sha" "$change" "$previous"
