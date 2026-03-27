#!/usr/bin/env bash

echo "Running composer..."
composer install --no-dev --working-dir=/var/www/html

cd /var/www/html

echo "Generating app key (if missing)..."
php artisan key:generate --force || true

echo "Setting permissions..."
chmod -R 775 storage bootstrap/cache

echo "Clearing old cache..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Publishing cloudinary provider..."
php artisan vendor:publish \
  --provider="CloudinaryLabs\CloudinaryLaravel\CloudinaryServiceProvider" \
  --tag="cloudinary-laravel-config" || true

echo "Running migrations..."
php artisan migrate --force

echo "Starting nginx + php-fpm..."
/start.sh