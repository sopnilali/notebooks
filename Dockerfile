# Dockerfile — Laravel on Vercel (Docker deployment)
# Multi-stage: Node.js builds frontend, PHP+Apache serves the app

# ---------------------------------------------------------------
# Stage 1: Frontend build (Vite + Tailwind v4)
# ---------------------------------------------------------------
FROM node:20-alpine AS frontend
WORKDIR /app

COPY package.json package-lock.json* ./
RUN npm ci --ignore-scripts

COPY vite.config.js ./
COPY resources/css ./resources/css
COPY resources/js ./resources/js

RUN npm run build

# ---------------------------------------------------------------
# Stage 2: PHP runtime (Apache)
# ---------------------------------------------------------------
FROM php:8.3-apache

# System dependencies + PHP extensions
RUN apt-get update && apt-get install -y \
        git \
        curl \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        libzip-dev \
        unzip \
        zip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

ENV COMPOSER_ALLOW_SUPERUSER=1

# Copy application code first (needed for artisan during composer post-autoload-dump)
COPY . .

# PHP dependencies (runs after code copy so artisan exists)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev --ignore-platform-reqs

# Built frontend assets
COPY --from=frontend /app/public/build ./public/build

# Entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Storage + cache permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Vercel provides PORT env var
ENV PORT=8080

EXPOSE ${PORT}

HEALTHCHECK --interval=30s --timeout=3s --start-period=10s --retries=3 \
    CMD curl -f http://localhost:${PORT}/up || exit 1

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
