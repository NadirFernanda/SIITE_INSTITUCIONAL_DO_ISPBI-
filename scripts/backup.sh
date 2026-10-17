#!/usr/bin/env bash
set -euo pipefail

# Backup diário: dump da base de dados (PostgreSQL/MySQL/SQLite, conforme
# DB_CONNECTION), storage/app (ficheiros enviados por utilizadores) e uma
# cópia do .env. Guarda tudo em BACKUP_DIR e apaga automaticamente o que
# tiver mais de RETENTION_DAYS dias, para não encher o disco.
#
# Uso (cron, a correr como root a partir de qualquer directoria):
#   APP_DIR=/var/www/isp-bie.ao BACKUP_DIR=/var/backups/isp-bie bash scripts/backup.sh

APP_DIR="${APP_DIR:-$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)}"
BACKUP_DIR="${BACKUP_DIR:-/var/backups/isp-bie}"
RETENTION_DAYS="${RETENTION_DAYS:-14}"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)

install -d -m 700 "$BACKUP_DIR"
echo "[backup] A iniciar backup: $TIMESTAMP"

# As credenciais de BD normalmente já vêm como variáveis de ambiente (ex.:
# secrets do GitHub Actions). Se não vierem, lê-las do .env real da app.
if [ -z "${DB_DATABASE:-}" ] && [ -f "$APP_DIR/.env" ]; then
  set -a
  # shellcheck disable=SC1091
  source "$APP_DIR/.env"
  set +a
fi

DB_CONNECTION="${DB_CONNECTION:-pgsql}"

if [ "$DB_CONNECTION" = "pgsql" ] && command -v pg_dump >/dev/null 2>&1 && [ -n "${DB_DATABASE:-}" ]; then
  echo "[backup] A criar dump PostgreSQL de ${DB_DATABASE}..."
  PGPASSWORD="${DB_PASSWORD:-}" pg_dump \
    -h "${DB_HOST:-127.0.0.1}" -p "${DB_PORT:-5432}" \
    -U "${DB_USERNAME:-postgres}" -Fc \
    -f "$BACKUP_DIR/${DB_DATABASE}_$TIMESTAMP.dump" \
    "${DB_DATABASE}"
elif [ "$DB_CONNECTION" = "mysql" ] && command -v mysqldump >/dev/null 2>&1 && [ -n "${DB_DATABASE:-}" ]; then
  echo "[backup] A criar dump MySQL de ${DB_DATABASE}..."
  mysqldump -h "${DB_HOST:-localhost}" -P "${DB_PORT:-3306}" -u "${DB_USERNAME:-}" -p"${DB_PASSWORD:-}" "${DB_DATABASE}" \
    > "$BACKUP_DIR/${DB_DATABASE}_$TIMESTAMP.sql"
elif [ "$DB_CONNECTION" = "sqlite" ] && [ -n "${DB_DATABASE:-}" ] && [ -f "$APP_DIR/${DB_DATABASE}" ]; then
  echo "[backup] A copiar base de dados SQLite..."
  cp "$APP_DIR/${DB_DATABASE}" "$BACKUP_DIR/database_$TIMESTAMP.sqlite"
else
  echo "[backup] AVISO: não foi possível fazer dump da base de dados (motor '$DB_CONNECTION' não suportado aqui, ferramenta em falta, ou DB_DATABASE vazio)." >&2
fi

if [ -d "$APP_DIR/storage/app" ]; then
  echo "[backup] A arquivar storage/app..."
  tar -czf "$BACKUP_DIR/storage_${TIMESTAMP}.tar.gz" -C "$APP_DIR" storage/app
fi

if [ -f "$APP_DIR/.env" ]; then
  cp "$APP_DIR/.env" "$BACKUP_DIR/.env_$TIMESTAMP"
fi

echo "[backup] A limpar backups com mais de ${RETENTION_DAYS} dias..."
find "$BACKUP_DIR" -maxdepth 1 -type f -mtime "+${RETENTION_DAYS}" -delete

echo "[backup] Concluído. Backups em $BACKUP_DIR"
