#!/usr/bin/env bash
# Build only from tracked application paths plus dependency/build outputs.
set -euo pipefail
umask 077
die() { echo "[release] $*" >&2; exit 1; }

sha="${1:-}"
[[ "$sha" =~ ^[0-9a-f]{40}$ ]] || die 'SHA completo obrigatório.'
[[ "$(git rev-parse HEAD)" == "$sha" ]] || die 'Checkout não corresponde ao SHA aprovado.'
git diff --quiet && git diff --cached --quiet || die 'Checkout com alterações rastreadas.'
[[ -f vendor/autoload.php && -f public/build/manifest.json ]] || die 'Dependências ou build Vite ausentes.'

mkdir -p dist
work=$(mktemp -d)
trap 'rm -rf -- "$work"' EXIT
mkdir -p "$work/release"
git archive "$sha" app bootstrap config database resources routes public artisan composer.json composer.lock \
    | tar -xf - -C "$work/release"
cp -a vendor "$work/release/vendor"
rm -rf -- "$work/release/vendor/bin"
cp -a public/build "$work/release/public/build"
printf '%s\n' "$sha" > "$work/release/RELEASE_SHA"

[[ ! -e "$work/release/.env" && ! -e "$work/release/storage" && ! -e "$work/release/public/storage" ]] \
    || die 'Credencial ou dados incluídos no pacote.'
[[ -z "$(find "$work/release" -type l -print -quit)" ]] || die 'Links simbólicos no pacote.'
[[ -z "$(find "$work/release" -type f \( -name '.env' -o -name '.env.*' -o -name '*.dump' -o -name '*.sqlite' \) -print -quit)" ]] \
    || die 'Ficheiro sensível no pacote.'

tar -C "$work/release" -czf dist/release.tar.gz .
(cd dist && sha256sum release.tar.gz > release.tar.gz.sha256 && sha256sum -c release.tar.gz.sha256)
echo "[release] Artefacto criado para $sha"
