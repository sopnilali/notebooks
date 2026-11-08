#!/bin/bash
set -e

# -----------------------------------------------------------------
# 1. Create .env from .env.example if missing
# -----------------------------------------------------------------
if [ ! -f .env ]; then
    cp .env.example .env
fi

# -----------------------------------------------------------------
# 2. Generate APP_KEY if not provided via environment
# -----------------------------------------------------------------
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# -----------------------------------------------------------------
# 3. Configure Apache to listen on Vercel's PORT
# -----------------------------------------------------------------
PORT=${PORT:-8080}
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# -----------------------------------------------------------------
# 4. Cache config, routes, views for production
# -----------------------------------------------------------------
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

# -----------------------------------------------------------------
# 5. Run migrations
# -----------------------------------------------------------------
php artisan migrate --force 2>/dev/null || true

# -----------------------------------------------------------------
# 6. Start Apache
# -----------------------------------------------------------------
exec apache2-foreground
