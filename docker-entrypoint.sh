#!/bin/bash
set -e

# -----------------------------------------------------------------
# 1. Create .env from .env.example if missing
# -----------------------------------------------------------------
if [ ! -f .env ]; then
    cp .env.example .env
fi

# -----------------------------------------------------------------
# 2. Override .env values from Docker/Vercel environment variables
# -----------------------------------------------------------------
if [ -n "$APP_KEY" ]; then
    sed -i "s|^APP_KEY=.*|APP_KEY=${APP_KEY}|" .env
fi

if [ -n "$APP_URL" ]; then
    sed -i "s|^APP_URL=.*|APP_URL=${APP_URL}|" .env
fi

if [ -n "$APP_ENV" ]; then
    sed -i "s|^APP_ENV=.*|APP_ENV=${APP_ENV}|" .env
fi

if [ -n "$APP_DEBUG" ]; then
    sed -i "s|^APP_DEBUG=.*|APP_DEBUG=${APP_DEBUG}|" .env
fi

if [ -n "$DB_CONNECTION" ]; then
    sed -i "s|^DB_CONNECTION=.*|DB_CONNECTION=${DB_CONNECTION}|" .env
fi

if [ -n "$DB_HOST" ]; then
    sed -i "s|^DB_HOST=.*|DB_HOST=${DB_HOST}|" .env
fi

if [ -n "$DB_PORT" ]; then
    sed -i "s|^DB_PORT=.*|DB_PORT=${DB_PORT}|" .env
fi

if [ -n "$DB_DATABASE" ]; then
    sed -i "s|^DB_DATABASE=.*|DB_DATABASE=${DB_DATABASE}|" .env
fi

if [ -n "$DB_USERNAME" ]; then
    sed -i "s|^DB_USERNAME=.*|DB_USERNAME=${DB_USERNAME}|" .env
fi

if [ -n "$DB_PASSWORD" ]; then
    sed -i "s|^DB_PASSWORD=.*|DB_PASSWORD=${DB_PASSWORD}|" .env
fi

if [ -n "$SESSION_DRIVER" ]; then
    sed -i "s|^SESSION_DRIVER=.*|SESSION_DRIVER=${SESSION_DRIVER}|" .env
fi

if [ -n "$CACHE_STORE" ]; then
    sed -i "s|^CACHE_STORE=.*|CACHE_STORE=${CACHE_STORE}|" .env
fi

if [ -n "$QUEUE_CONNECTION" ]; then
    sed -i "s|^QUEUE_CONNECTION=.*|QUEUE_CONNECTION=${QUEUE_CONNECTION}|" .env
fi

if [ -n "$LOG_CHANNEL" ]; then
    sed -i "s|^LOG_CHANNEL=.*|LOG_CHANNEL=${LOG_CHANNEL}|" .env
fi

# -----------------------------------------------------------------
# 3. Generate APP_KEY if still not provided
# -----------------------------------------------------------------
if ! grep -q "^APP_KEY=base64:" .env 2>/dev/null; then
    php artisan key:generate --force
fi

# -----------------------------------------------------------------
# 4. Fix file permissions (runtime-safe)
# -----------------------------------------------------------------
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public 2>/dev/null || true
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public 2>/dev/null || true

# -----------------------------------------------------------------
# 5. Configure Apache to listen on Vercel's PORT
# -----------------------------------------------------------------
PORT=${PORT:-8080}
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# -----------------------------------------------------------------
# 6. Cache config, routes, views for production (non-fatal)
# -----------------------------------------------------------------
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

# -----------------------------------------------------------------
# 7. Run migrations (non-fatal — app should still start if DB isn't ready)
# -----------------------------------------------------------------
php artisan migrate --force 2>/dev/null || true

# -----------------------------------------------------------------
# 8. Start Apache
# -----------------------------------------------------------------
exec apache2-foreground
