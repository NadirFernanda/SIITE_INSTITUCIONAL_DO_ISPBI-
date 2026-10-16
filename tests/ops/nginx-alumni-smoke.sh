#!/usr/bin/env bash
# Isolated fixture: no production host or document is accessed.
set -euo pipefail
command -v nginx >/dev/null && command -v curl >/dev/null || { echo 'nginx e curl obrigatórios' >&2; exit 1; }
repo=$(cd "$(dirname "$0")/../.." && pwd)
tmp=$(mktemp -d)
port="${NGINX_TEST_PORT:-18081}"
[[ "$port" =~ ^[0-9]{1,5}$ ]] || exit 1
cleanup() {
    nginx -p "$tmp/" -c "$tmp/nginx.conf" -s quit >/dev/null 2>&1 || true
    rm -rf -- "$tmp"
}
trap cleanup EXIT
mkdir -p "$tmp/public/storage/alumni-documentos" "$tmp/public/storage/noticias"
printf 'private fixture\n' > "$tmp/public/storage/alumni-documentos/legacy.pdf"
printf 'public fixture\n' > "$tmp/public/storage/noticias/exemplo.pdf"
cat > "$tmp/nginx.conf" <<CONF
pid $tmp/nginx.pid;
error_log $tmp/error.log;
events {}
http {
    server {
        listen 127.0.0.1:$port;
        server_name localhost;
        root $tmp/public;
        include $repo/docs/proposals/nginx-alumni.conf;
        location / { try_files \$uri =404; }
    }
}
CONF
nginx -p "$tmp/" -c "$tmp/nginx.conf" -t
nginx -p "$tmp/" -c "$tmp/nginx.conf"
status() { curl --path-as-is -sS -o /dev/null -w '%{http_code}' "http://127.0.0.1:$port$1"; }
[[ "$(status /storage/alumni-documentos)" == 404 ]]
[[ "$(status /storage/alumni-documentos/legacy.pdf)" == 404 ]]
[[ "$(status '/storage/%61lumni-documentos/legacy.pdf?x=1')" == 404 ]]
[[ "$(status /storage/noticias/exemplo.pdf)" == 200 ]]
echo 'Nginx alumni: bloqueio específico e documento público preservado.'
