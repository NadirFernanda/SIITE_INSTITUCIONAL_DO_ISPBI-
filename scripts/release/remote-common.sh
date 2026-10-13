#!/usr/bin/env bash
# Sourced by the two operator-side release scripts.
release_die() { echo "[release] $*" >&2; exit 1; }
release_sha_valid() { [[ "$1" =~ ^[0-9a-f]{40}$ ]]; }
release_safe_path() { [[ "$1" =~ ^/[A-Za-z0-9._/-]+$ && "$1" != *'..'* && "$1" != */ ]]; }

release_prepare_ssh() {
    local name
    for name in DEPLOY_HOST DEPLOY_USER DEPLOY_KNOWN_HOSTS DEPLOY_SSH_PRIVATE_KEY RELEASE_ROOT SHARED_ROOT CURRENT_LINK HEALTH_URL; do
        [[ -n "${!name:-}" ]] || release_die "Variável obrigatória ausente: $name"
    done
    [[ "$DEPLOY_HOST" =~ ^[A-Za-z0-9.-]+$ && "$DEPLOY_USER" =~ ^[a-z_][a-z0-9_-]*$ ]] || release_die 'Destino SSH inválido.'
    for name in RELEASE_ROOT SHARED_ROOT CURRENT_LINK; do
        release_safe_path "${!name}" || release_die "Caminho remoto inválido: $name"
    done
    [[ "$HEALTH_URL" =~ ^https?://[A-Za-z0-9.-]+(:[0-9]{1,5})?(/[A-Za-z0-9/_-]*)?$ ]] || release_die 'HEALTH_URL inválido.'
    local port="${DEPLOY_PORT:-22}"
    [[ "$port" =~ ^[0-9]{1,5}$ ]] || release_die 'Porta SSH inválida.'
    release_ssh_tmp=$(mktemp -d)
    trap 'rm -rf -- "$release_ssh_tmp"' EXIT
    printf '%s\n' "$DEPLOY_SSH_PRIVATE_KEY" > "$release_ssh_tmp/key"
    printf '%s\n' "$DEPLOY_KNOWN_HOSTS" > "$release_ssh_tmp/known_hosts"
    chmod 600 "$release_ssh_tmp/key" "$release_ssh_tmp/known_hosts"
    release_ssh_opts=(-i "$release_ssh_tmp/key" -o BatchMode=yes -o IdentitiesOnly=yes
        -o StrictHostKeyChecking=yes -o UserKnownHostsFile="$release_ssh_tmp/known_hosts")
    release_port="$port"
    release_target="$DEPLOY_USER@$DEPLOY_HOST"
}
