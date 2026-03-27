#!/usr/bin/env bash

echo "Installing dependencies..."
composer install --no-dev --working-dir=/var/www/html/biblo-app

cd /var/www/html/biblo-app

echo "Generating application key..."
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

echo "Running migrations..."
php artisan migrate --force

echo "Seeding database..."
php artisan db:seed --force

echo "Deploy script finished!"