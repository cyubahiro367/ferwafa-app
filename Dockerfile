FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    nginx supervisor curl git zip unzip \
    libpng-dev oniguruma-dev libxml2-dev \
    nodejs npm bash

# PHP extensions
RUN docker-php-ext-install \
    pdo pdo_mysql mbstring exif pcntl bcmath gd

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy app files
COPY . .

# Install PHP dependencies (production only)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install & build frontend assets
RUN npm ci && npm run build && rm -rf node_modules

# Create required Laravel directories
RUN mkdir -p \
    storage/logs \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Copy nginx and supervisor configs
COPY docker/nginx.conf      /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisord.conf

# Copy and set startup script
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]