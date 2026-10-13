#!/usr/bin/env bash
# Creates disposable source and build fixtures; no application data is read.
set -euo pipefail
repo=$(cd "$(dirname "$0")/../.." && pwd)
tmp=$(mktemp -d)
trap 'rm -rf -- "$tmp"' EXIT
cd "$tmp"
git init -q
mkdir -p app bootstrap config database resources routes public vendor public/build storage
for dir in app bootstrap config database resources routes; do printf 'fixture\n' > "$dir/.fixture"; done
printf 'fixture\n' > public/index.php
printf 'fixture\n' > artisan
printf '{}\n' > composer.json
printf '{}\n' > composer.lock
git add app bootstrap config database resources routes public artisan composer.json composer.lock
git -c user.name='Release Test' -c user.email='release-test@example.invalid' commit -qm fixture
printf 'vendor\n' > vendor/autoload.php
printf '{}\n' > public/build/manifest.json
printf 'must not ship\n' > .env
printf 'must not ship\n' > storage/private-document.pdf
sha=$(git rev-parse HEAD)
bash "$repo/scripts/release/build-artifact.sh" "$sha"
[[ -s dist/release.tar.gz && -s dist/release.tar.gz.sha256 ]]
tar -tzf dist/release.tar.gz | grep -q '^./RELEASE_SHA$'
tar -tzf dist/release.tar.gz | grep -q '^./vendor/autoload.php$'
tar -tzf dist/release.tar.gz | grep -q '^./public/build/manifest.json$'
if tar -tzf dist/release.tar.gz | grep -Eq '(^|/)(\.env|storage)(/|$)'; then
    echo 'Artefacto contém dados privados.' >&2
    exit 1
fi
echo 'Artefacto isolado validado: apenas caminhos permitidos.'
