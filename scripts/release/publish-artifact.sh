#!/usr/bin/env bash
# Operator-side upload and activation; never runs migrations.
set -euo pipefail
source "$(dirname "$0")/remote-common.sh"
[[ $# -eq 3 ]] || release_die 'Uso: publish-artifact.sh ARTIFACT SHA CHANGE_ID'
artifact="$1"; sha="$2"; change="$3"
release_sha_valid "$sha" && [[ "$change" =~ ^[A-Za-z0-9._-]{3,80}$ ]] || release_die 'SHA ou mudança inválidos.'
[[ -f "$artifact" && -f "$artifact.sha256" ]] || release_die 'Artefacto ou checksum ausente.'
(cd "$(dirname "$artifact")" && sha256sum -c "$(basename "$artifact").sha256") || release_die 'Checksum local inválido.'
hash=$(sha256sum "$artifact" | cut -d ' ' -f 1)
release_prepare_ssh
remote_dir="$RELEASE_ROOT/incoming"
remote_archive="$remote_dir/$sha-$change.tar.gz"
remote_script="$remote_dir/activate-$sha-$change.sh"
ssh "${release_ssh_opts[@]}" -p "$release_port" "$release_target" "mkdir -p '$remote_dir'"
scp "${release_ssh_opts[@]}" -P "$release_port" -- "$artifact" "$release_target:$remote_archive"
scp "${release_ssh_opts[@]}" -P "$release_port" -- "$(dirname "$0")/activate-release.sh" "$release_target:$remote_script"
ssh "${release_ssh_opts[@]}" -p "$release_port" "$release_target" \
    "bash '$remote_script' publish '$remote_archive' '$sha' '$hash' '$change' '$RELEASE_ROOT' '$SHARED_ROOT' '$CURRENT_LINK' '$HEALTH_URL'"
