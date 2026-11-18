# Stage 1: Build frontend assets
FROM node:22-alpine AS frontend

WORKDIR /app

COPY package*.json ./

RUN npm install

COPY . .

RUN npm run build


# Stage 2: Laravel application
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    curl \
    libzip-dev \
    libsqlite3-dev \
    libonig-dev \
    && docker-php-ext-install \
    pdo \
    pdo_sqlite \
    mbstring \
    bcmath \
    zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*


# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer


# Working directory
WORKDIR /var/www/html


# Copy Laravel project
COPY . .


# Install Laravel dependencies
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction


# Copy Vite production assets
COPY --from=frontend /app/public/build ./public/build


# Create Laravel directories
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    /var/data


# Set permissions
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache \
    /var/data \
    && chmod -R 775 storage bootstrap/cache /var/data


# Copy Nginx configuration
COPY nginx.conf /etc/nginx/sites-available/default


# Copy startup script
COPY start.sh /start.sh

RUN chmod +x /start.sh


# Expose Render port
EXPOSE 8080


# Start application
CMD ["/start.sh"]