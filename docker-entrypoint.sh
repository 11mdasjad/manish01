#!/bin/bash
set -e

# Port configuration for Render (Render sets $PORT dynamically, default 10000)
PORT="${PORT:-10000}"
echo "Configuring Apache for PORT: $PORT"
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost \*:${PORT}>/g" /etc/apache2/sites-available/000-default.conf

# Prepare .env file if missing
if [ ! -f /var/www/html/.env ]; then
    echo "Creating .env from .env.example..."
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Auto-configure Render HTTPS URL
if [ -n "$RENDER_EXTERNAL_URL" ]; then
    echo "Configuring APP_URL for Render: $RENDER_EXTERNAL_URL"
    sed -i "s|^APP_URL=.*|APP_URL=${RENDER_EXTERNAL_URL}|g" /var/www/html/.env
    sed -i "s|^APP_ENV=.*|APP_ENV=production|g" /var/www/html/.env
elif [ -n "$RENDER_EXTERNAL_HOSTNAME" ]; then
    echo "Configuring APP_URL for Render: https://$RENDER_EXTERNAL_HOSTNAME"
    sed -i "s|^APP_URL=.*|APP_URL=https://${RENDER_EXTERNAL_HOSTNAME}|g" /var/www/html/.env
    sed -i "s|^APP_ENV=.*|APP_ENV=production|g" /var/www/html/.env
fi

# Ensure SQLite database exists if SQLite is used
if [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then
    mkdir -p /var/www/html/database
    if [ ! -f /var/www/html/database/database.sqlite ]; then
        touch /var/www/html/database/database.sqlite
    fi
    chown -R www-data:www-data /var/www/html/database
    chmod -R 775 /var/www/html/database
fi

# Ensure storage directories and permissions
mkdir -p /var/www/html/storage/framework/cache/data \
         /var/www/html/storage/framework/sessions \
         /var/www/html/storage/framework/views \
         /var/www/html/storage/logs \
         /var/www/html/bootstrap/cache

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Generate APP_KEY if empty and not provided via env
if [ -z "$APP_KEY" ] && ! grep -q "^APP_KEY=base64:" /var/www/html/.env; then
    echo "Generating Application Key..."
    php artisan key:generate --force
fi

# Run database migrations and seeding
echo "Running database migrations..."
php artisan migrate --force

echo "Seeding corporate real estate data..."
php artisan db:seed --class=CorporateSeeder --force || true

# Clear stale config cache to ensure dynamic HTTPS & reverse-proxy headers apply
echo "Optimizing framework..."
php artisan config:clear || true
php artisan route:clear || true
php artisan view:cache || true

echo "Starting Apache web server on port ${PORT}..."
exec apache2-foreground
