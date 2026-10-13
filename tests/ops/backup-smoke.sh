#!/usr/bin/env bash
# Disposable fake PostgreSQL/S3 commands exercise backup failure handling.
set -euo pipefail
repo=$(cd "$(dirname "$0")/../.." && pwd)
tmp=$(mktemp -d)
trap 'rm -rf -- "$tmp"' EXIT
mkdir -p "$tmp/app/storage/app/public/alumni-documentos" "$tmp/app/storage/app/private/alumni" "$tmp/bin"
printf 'artisan fixture\n' > "$tmp/app/artisan"
printf 'document fixture\n' > "$tmp/app/storage/app/public/alumni-documentos/legacy.pdf"
cat > "$tmp/bin/pg_dump" <<'SH'
#!/usr/bin/env bash
[[ "${MOCK_DUMP_FAIL:-0}" == 0 ]] || exit 42
while [[ $# -gt 0 ]]; do
    if [[ "$1" == -f ]]; then printf 'FAKE PG DUMP\n' > "$2"; exit 0; fi
    shift
done
exit 1
SH
cat > "$tmp/bin/pg_restore" <<'SH'
#!/usr/bin/env bash
[[ "$1" == --list && -s "$2" ]]
SH
cat > "$tmp/bin/aws" <<'SH'
#!/usr/bin/env bash
[[ "$1" == s3 && "$2" == cp ]] || exit 1
[[ "${MOCK_S3_FAIL:-0}" == 0 ]] || exit 43
if [[ "$4" == s3://* ]]; then cp "$3" "$MOCK_S3_FILE"; else cp "$MOCK_S3_FILE" "$4"; fi
SH
cat > "$tmp/bin/flock" <<'SH'
#!/usr/bin/env bash
exit 0
SH
cat > "$tmp/bin/install" <<'SH'
#!/usr/bin/env bash
mkdir -p "${@: -1}"
SH
chmod +x "$tmp/bin/pg_dump" "$tmp/bin/pg_restore" "$tmp/bin/aws" "$tmp/bin/flock" "$tmp/bin/install"
export PATH="$tmp/bin:$PATH" MOCK_S3_FILE="$tmp/remote.tar.gz"
export APP_DIR="$tmp/app" STORAGE_DIR="$tmp/app/storage/app" BACKUP_DIR="$tmp/backups"
export DB_CONNECTION=pgsql DB_HOST=127.0.0.1 DB_PORT=55432 DB_DATABASE=isp_bie_test
export DB_USERNAME=isp_bie_test DB_PASSWORD=fixture BACKUP_S3_BUCKET=fixture-bucket
bash "$repo/scripts/backup.sh"
complete=("$tmp/backups"/backup-*)
[[ ${#complete[@]} -eq 1 && -f "${complete[0]}/.complete" ]]
(cd "${complete[0]}" && sha256sum -c SHA256SUMS)
tar -tzf "${complete[0]}/storage.tar.gz" | grep -q 'alumni-documentos/legacy.pdf'
if MOCK_DUMP_FAIL=1 bash "$repo/scripts/backup.sh"; then
    echo 'Backup falso positivo após falha da base.' >&2
    exit 1
fi
complete=("$tmp/backups"/backup-*)
[[ ${#complete[@]} -eq 1 && -f "${complete[0]}/.complete" ]]
if MOCK_S3_FAIL=1 bash "$repo/scripts/backup.sh"; then
    echo 'Backup falso positivo após falha da cópia externa.' >&2
    exit 1
fi
complete=("$tmp/backups"/backup-*)
[[ ${#complete[@]} -eq 1 && -f "${complete[0]}/.complete" ]]
echo 'Backup isolado: base, documentos, hash, cópia externa e falha segura verificados.'
