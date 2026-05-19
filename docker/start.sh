#!/bin/sh
set -e

echo "==> Starting FERWAFA Laravel App..."
cd /var/www/html

echo "==> Checking APP_KEY..."
if [ -z "$APP_KEY" ]; then
    echo "ERROR: APP_KEY is not set. Set it in Render environment variables."
    exit 1
fi

echo "==> Caching config..."
php artisan config:cache 2>&1 || echo "Config cache failed - continuing"

echo "==> Caching routes..."
php artisan route:cache 2>&1 || echo "Route cache failed - continuing"

echo "==> Caching views..."
php artisan view:cache 2>&1 || echo "View cache failed - continuing"

echo "==> Running migrations..."
php artisan migrate --force 2>&1 || echo "Migration failed - check DB credentials"

echo "==> Linking storage..."
php artisan storage:link 2>&1 || echo "Storage link already exists"

echo "==> Fixing permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "==> Starting supervisord (nginx + php-fpm)..."
exec /usr/bin/supervisord -c /etc/supervisord.conf