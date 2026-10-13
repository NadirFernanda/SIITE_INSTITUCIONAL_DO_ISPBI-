#!/usr/bin/env bash
# Operator-side rollback to an already staged release; no database changes.
set -euo pipefail
source "$(dirname "$0")/remote-common.sh"
[[ $# -eq 2 ]] || release_die 'Uso: rollback-release.sh SHA CHANGE_ID'
sha="$1"; change="$2"
release_sha_valid "$sha" && [[ "$change" =~ ^[A-Za-z0-9._-]{3,80}$ ]] || release_die 'SHA ou mudança inválidos.'
release_prepare_ssh
remote_dir="$RELEASE_ROOT/incoming"
remote_script="$remote_dir/rollback-$sha-$change.sh"
ssh "${release_ssh_opts[@]}" -p "$release_port" "$release_target" "mkdir -p '$remote_dir'"
scp "${release_ssh_opts[@]}" -P "$release_port" -- "$(dirname "$0")/activate-release.sh" "$release_target:$remote_script"
ssh "${release_ssh_opts[@]}" -p "$release_port" "$release_target" \
    "bash '$remote_script' rollback '$sha' '$change' '$RELEASE_ROOT' '$SHARED_ROOT' '$CURRENT_LINK' '$HEALTH_URL'"
