#!/bin/bash
set -e

echo "=== Laravel Vercel Entrypoint ==="

# -----------------------------------------------------------------
# 1. Create .env from .env.example if missing
# -----------------------------------------------------------------
if [ ! -f .env ]; then
    echo "Creating .env from .env.example..."
    cp .env.example .env
fi

# -----------------------------------------------------------------
# 2. Override .env values from Docker/Vercel environment variables
# -----------------------------------------------------------------
set_env() {
    local key="$1"
    local value="${!key}"
    if [ -n "$value" ]; then
        echo "Setting $key..."
        sed -i "s|^${key}=.*|${key}=${value}|" .env
    fi
}

set_env APP_KEY
set_env APP_URL
set_env APP_ENV
set_env APP_DEBUG
set_env DB_CONNECTION
set_env DB_HOST
set_env DB_PORT
set_env DB_DATABASE
set_env DB_USERNAME
set_env DB_PASSWORD
set_env SESSION_DRIVER
set_env CACHE_STORE
set_env QUEUE_CONNECTION
set_env LOG_CHANNEL

# -----------------------------------------------------------------
# 3. Generate APP_KEY if still not provided
# -----------------------------------------------------------------
if ! grep -q "^APP_KEY=base64:" .env 2>/dev/null; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
fi

echo "APP_KEY status:"
grep "^APP_KEY=" .env

# -----------------------------------------------------------------
# 4. Fix file permissions (runtime-safe)
# -----------------------------------------------------------------
echo "Fixing permissions..."
mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public 2>/dev/null || true
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public 2>/dev/null || true

# -----------------------------------------------------------------
# 5. Clear stale caches (important when env vars change)
# -----------------------------------------------------------------
echo "Clearing caches..."
php artisan config:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true
php -r "opcache_reset();" 2>/dev/null || true

# -----------------------------------------------------------------
# 6. Configure Apache to listen on Vercel's PORT
# -----------------------------------------------------------------
PORT=${PORT:-8080}
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# -----------------------------------------------------------------
# 7. Cache config, routes, views for production
# -----------------------------------------------------------------
echo "Caching config..."
php artisan config:cache 2>/dev/null || echo "config:cache failed"
php artisan route:cache 2>/dev/null || echo "route:cache failed"
php artisan view:cache 2>/dev/null || echo "view:cache failed"

# -----------------------------------------------------------------
# 8. Run migrations
# -----------------------------------------------------------------
echo "Running migrations..."
php artisan migrate --force 2>/dev/null || echo "migrate failed"

# -----------------------------------------------------------------
# 9. Regenerate autoloader
# -----------------------------------------------------------------
composer dump-autoload --no-dev --optimize 2>/dev/null || true

# -----------------------------------------------------------------
# 10. Start Apache
# -----------------------------------------------------------------
echo "=== Starting Apache on port ${PORT} ==="
exec apache2-foreground
