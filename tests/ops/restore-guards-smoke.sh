#!/usr/bin/env bash
# Prove the restore drill rejects production-shaped targets before any DB call.
set -euo pipefail
repo=$(cd "$(dirname "$0")/../.." && pwd)
tmp=$(mktemp -d)
trap 'rm -rf -- "$tmp"' EXIT
touch "$tmp/.complete" "$tmp/database.dump" "$tmp/storage.tar.gz" "$tmp/SHA256SUMS"
if output=$(RESTORE_HOST=production.invalid RESTORE_PORT=5432 RESTORE_DB=production \
    RESTORE_USER=postgres bash "$repo/scripts/backup/verify-restore.sh" "$tmp" 2>&1); then
    echo 'Restauro inseguro foi aceite.' >&2
    exit 1
fi
[[ "$output" == *'Ligação não isolada recusada.'* ]]
echo 'Restauro: destino de produção rejeitado antes de qualquer operação de base.'
