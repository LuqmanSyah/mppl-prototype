#!/bin/bash
set -e

PROJECT_NAME="${PROJECT_NAME:-mppl}"
APP_DOMAIN="${APP_DOMAIN:-${PROJECT_NAME}.test}"
APP_URL="${APP_URL:-https://${APP_DOMAIN}}"
APP_DIR="/var/www/html"
ENV_FILE="${APP_DIR}/.env"

echo "Starting Laravel container setup for ${PROJECT_NAME}..."

cd "${APP_DIR}"

if [ -z "$(find "${APP_DIR}" -mindepth 1 -not -path "${APP_DIR}/.gitkeep" -print -quit)" ]; then
  echo "Source directory is empty. Creating Laravel project..."
  composer create-project --prefer-dist raugadh/fila-starter:2.0 . --no-interaction
else
  echo "Laravel source exists. Skipping create-project."
fi

if [ ! -f "${ENV_FILE}" ]; then
  echo "Creating Laravel .env from Docker defaults..."
  cat <<EOF > "${ENV_FILE}"
APP_NAME="${PROJECT_NAME}"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE='Asia/Jakarta'
APP_URL="${APP_URL}"
ASSET_URL="${APP_URL}"
DEBUGBAR_ENABLED=false
ASSET_PREFIX=
# ASSET_PREFIX=/dev/kit/public example in case deployed inside a folder

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mariadb
DB_HOST=db
DB_PORT=3306
DB_DATABASE="${PROJECT_NAME}"
DB_USERNAME=root
DB_PASSWORD=p455w0rd

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=true
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="\${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="\${APP_NAME}"
EOF
else
  echo "Laravel .env already exists. Keeping local values."
fi

env_value() {
  local key="$1"
  grep -E "^${key}=" "${ENV_FILE}" | tail -n 1 | cut -d '=' -f 2- | sed 's/^"//; s/"$//'
}

DB_HOST="$(env_value DB_HOST)"
DB_PORT="$(env_value DB_PORT)"
DB_HOST="${DB_HOST:-db}"
DB_PORT="${DB_PORT:-3306}"

echo "Waiting for database at ${DB_HOST}:${DB_PORT}..."
RETRIES=30
until nc -z "${DB_HOST}" "${DB_PORT}"; do
  if [ "${RETRIES}" -le 0 ]; then
    echo "Timeout waiting for database. Exiting."
    exit 1
  fi

  echo "Database is not ready yet..."
  sleep 2
  RETRIES=$((RETRIES - 1))
done
echo "Database is ready."

if [ ! -d "${APP_DIR}/vendor" ]; then
  echo "Installing Composer dependencies..."
  composer install --no-interaction --prefer-dist --optimize-autoloader
else
  echo "Composer dependencies already installed."
fi

if ! grep -q '^APP_KEY=base64:' "${ENV_FILE}"; then
  echo "Generating Laravel application key..."
  php artisan key:generate --force
fi

if [ -f "${APP_DIR}/package.json" ]; then
  if [ ! -d "${APP_DIR}/node_modules" ]; then
    echo "Installing Node dependencies..."
    if [ -f "${APP_DIR}/package-lock.json" ]; then
      npm ci --no-audit --no-fund
    else
      npm install --no-audit --no-fund
    fi
  else
    echo "Node dependencies already installed."
  fi

  if [ ! -f "${APP_DIR}/public/build/manifest.json" ]; then
    echo "Building frontend assets..."
    npm run build
  else
    echo "Frontend build manifest exists. Skipping npm run build."
  fi
fi

echo "Preparing Laravel writable directories..."
mkdir -p \
  "${APP_DIR}/storage/app/private" \
  "${APP_DIR}/storage/app/public" \
  "${APP_DIR}/storage/framework/cache" \
  "${APP_DIR}/storage/framework/sessions" \
  "${APP_DIR}/storage/framework/testing" \
  "${APP_DIR}/storage/framework/views" \
  "${APP_DIR}/storage/logs" \
  "${APP_DIR}/bootstrap/cache"

chmod -R 775 "${APP_DIR}/storage" "${APP_DIR}/bootstrap/cache"
chown -R www-data:www-data "${APP_DIR}/storage" "${APP_DIR}/bootstrap/cache"

echo "Running database migrations..."
php artisan migrate --force

echo "Running database seeders..."
php artisan db:seed --force

echo "Creating storage link..."
if [ ! -L "${APP_DIR}/public/storage" ]; then
  php artisan storage:link || true
else
  echo "Storage link already exists."
fi

echo "Clearing Laravel caches..."
php artisan optimize:clear || true
php artisan filament:optimize-clear || true

echo "Starting cron service..."
service cron start

ENV_FILE="${APP_DIR}/.env"
for VAR in XDEBUG PHP_IDE_CONFIG REMOTE_HOST; do
  if [ -z "${!VAR}" ] && [ -f "${ENV_FILE}" ]; then
    VALUE=$(grep "^${VAR}=" "${ENV_FILE}" | cut -d '=' -f 2-)
    if [ -n "${VALUE}" ]; then
      sed -i "/${VAR}/d" ~/.bashrc
      echo "export ${VAR}=${VALUE}" >> ~/.bashrc
    fi
  fi
done
. ~/.bashrc

if [ -z "${REMOTE_HOST}" ]; then
  REMOTE_HOST="host.docker.internal"
  sed -i "/REMOTE_HOST/d" ~/.bashrc
  echo "export REMOTE_HOST=\"${REMOTE_HOST}\"" >> ~/.bashrc
  . ~/.bashrc
fi

XDEBUG_CONFIG="/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini"

if [ "${XDEBUG}" == "true" ] && [ ! -f "${XDEBUG_CONFIG}" ]; then
  echo "Enabling Xdebug..."
  sed -i '/PHP_IDE_CONFIG/d' /etc/cron.d/laravel-scheduler
  if [ -n "${PHP_IDE_CONFIG}" ]; then
    echo -e "PHP_IDE_CONFIG=\"${PHP_IDE_CONFIG}\"\n$(cat /etc/cron.d/laravel-scheduler)" > /etc/cron.d/laravel-scheduler
  fi
  docker-php-ext-enable xdebug
  {
    echo "xdebug.remote_enable=1"
    echo "xdebug.remote_autostart=1"
    echo "xdebug.remote_connect_back=0"
    echo "xdebug.remote_host=${REMOTE_HOST}"
  } >> "${XDEBUG_CONFIG}"
elif [ -f "${XDEBUG_CONFIG}" ]; then
  echo "Disabling Xdebug..."
  sed -i '/PHP_IDE_CONFIG/d' /etc/cron.d/laravel-scheduler
  rm -f "${XDEBUG_CONFIG}"
fi

echo "Laravel container setup complete."

exec "$@"
