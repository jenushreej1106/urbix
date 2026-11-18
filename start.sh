#!/bin/bash

set -e

cd /var/www/html

echo "Starting URBIX..."

# Persistent SQLite database
mkdir -p /var/data
touch /var/data/database.sqlite

# Configure SQLite database path
export DB_CONNECTION=sqlite
export DB_DATABASE=/var/data/database.sqlite

# Create Laravel directories
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Set permissions
chown -R www-data:www-data storage bootstrap/cache /var/data
chmod -R 775 storage bootstrap/cache /var/data

# Clear Laravel caches
php artisan optimize:clear

# Run database migrations
php artisan migrate --force

# Cache configuration
php artisan config:cache

# Start PHP-FPM
php-fpm -D

echo "Starting Nginx..."

# Start Nginx
exec nginx -g "daemon off;"