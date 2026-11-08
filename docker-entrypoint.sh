#!/bin/bash
set -e

# Create .env from .env.example if it doesn't exist
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Generate APP_KEY if not provided via environment
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Configure Apache to listen on Vercel's PORT
PORT=${PORT:-8080}
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# Cache config, routes, and views for production
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

# Run migrations
php artisan migrate --force 2>/dev/null || true

# Start Apache
exec apache2-foreground
