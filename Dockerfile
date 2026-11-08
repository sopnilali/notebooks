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
FROM php:8.4-apache

# System dependencies + PHP extensions
ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
        git \
        curl \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        libzip-dev \
        libpq-dev \
        unzip \
        zip \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip \
    && docker-php-ext-enable opcache \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

# Production opcache config
RUN { \
        echo "opcache.enable=1"; \
        echo "opcache.memory_consumption=128"; \
        echo "opcache.interned_strings_buffer=8"; \
        echo "opcache.max_accelerated_files=4000"; \
        echo "opcache.revalidate_freq=0"; \
        echo "opcache.validate_timestamps=0"; \
    } > /usr/local/etc/php/conf.d/opcache.ini

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

ENV COMPOSER_ALLOW_SUPERUSER=1

# Copy application code first (needed for artisan during composer post-autoload-dump)
COPY . .

# PHP dependencies (skip scripts during build; artisan may not be fully bootstrapped yet)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev --ignore-platform-reqs --no-scripts

# Configure Apache DocumentRoot to Laravel public directory
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|<Directory /var/www/html>|<Directory /var/www/html/public>|' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|AllowOverride None|AllowOverride All|' /etc/apache2/sites-available/000-default.conf

# Built frontend assets
COPY --from=frontend /app/public/build ./public/build

# Ensure no dev-server hot file exists (prevents @vite from pointing to dev server)
RUN rm -f /var/www/html/public/build/hot /var/www/html/public/hot 2>/dev/null || true

# Entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Storage + cache + bootstrap permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public

# Serve static assets with caching
RUN sed -i 's|</VirtualHost>|    <Location /build/>\n        Header set Cache-Control "public, max-age=31536000, immutable"\n    </Location>\n</VirtualHost>|' /etc/apache2/sites-available/000-default.conf

# Vercel provides PORT env var
ENV PORT=8080

EXPOSE ${PORT}

HEALTHCHECK --interval=30s --timeout=3s --start-period=10s --retries=3 \
    CMD curl -f http://localhost:${PORT}/up || exit 1

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
