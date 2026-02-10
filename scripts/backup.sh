#!/usr/bin/env bash
set -euo pipefail

TIMESTAMP=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="${BACKUP_DIR:-backups}"
mkdir -p "$BACKUP_DIR"

echo "[backup] Starting backup: $TIMESTAMP"

# Database dump (MySQL) if credentials provided and mysqldump available
if command -v mysqldump >/dev/null 2>&1 && [ -n "${DB_DATABASE:-}" ]; then
  echo "[backup] Dumping database ${DB_DATABASE}..."
  mysqldump -h "${DB_HOST:-localhost}" -P "${DB_PORT:-3306}" -u "${DB_USERNAME:-}" -p"${DB_PASSWORD:-}" "${DB_DATABASE}" > "$BACKUP_DIR/${DB_DATABASE}_$TIMESTAMP.sql"
else
  echo "[backup] Skipping DB dump; mysqldump not found or DB_DATABASE not set."
fi

# Archive storage folder (if present)
if [ -d storage ]; then
  echo "[backup] Archiving storage/..."
  tar -czf "$BACKUP_DIR/storage_${TIMESTAMP}.tar.gz" storage || true
else
  echo "[backup] storage/ not found; skipping."
fi

# Save .env if present
if [ -f .env ]; then
  echo "[backup] Copying .env"
  cp .env "$BACKUP_DIR/.env_$TIMESTAMP"
fi

# Create combined site backup (optional)
echo "[backup] Creating combined archive..."
cd "$BACKUP_DIR"
tar -czf "site_backup_$TIMESTAMP.tar.gz" . --remove-files || true
cd - >/dev/null

echo "[backup] Backups available in $BACKUP_DIR"

# Upload to S3 if configured
if [ -n "${BACKUP_S3_BUCKET:-}" ] && [ -n "${AWS_ACCESS_KEY_ID:-}" ]; then
  if ! command -v aws >/dev/null 2>&1; then
    echo "[backup] AWS CLI not found; attempting to install via pip..."
    if command -v pip >/dev/null 2>&1; then
      pip install --user awscli
      export PATH="$HOME/.local/bin:$PATH"
    else
      echo "[backup] pip not found; please install AWS CLI manually to enable S3 uploads."
    fi
  fi
  if command -v aws >/dev/null 2>&1; then
    echo "[backup] Uploading backups to s3://${BACKUP_S3_BUCKET}/$TIMESTAMP/"
    aws s3 cp "$BACKUP_DIR/" "s3://${BACKUP_S3_BUCKET}/$TIMESTAMP/" --recursive
    echo "[backup] Upload complete."
  else
    echo "[backup] AWS CLI still unavailable; skipping upload."
  fi
else
  echo "[backup] S3 upload skipped; BACKUP_S3_BUCKET or AWS credentials not provided."
fi

echo "[backup] Finished."
