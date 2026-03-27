#!/usr/bin/env bash

echo "Installing dependencies..."
composer install --no-dev --working-dir=/var/www/html/biblo-app

cd /var/www/html/biblo-app

echo "Setting up SQLite..."
mkdir -p database
touch database/database.sqlite
chmod 775 database/database.sqlite

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

echo "Running migrations + seed..."
php artisan migrate --force --seed

echo "Deploy script finished!"