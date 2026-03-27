#!/usr/bin/env bash

echo "Installing dependencies..."
composer install --no-dev --working-dir=/var/www/html/biblo-app

cd /var/www/html/biblo-app

echo "Setting up SQLite..."
mkdir -p database
touch database/database.sqlite

echo "Setting permissions..."
chmod -R 775 storage bootstrap/cache database

echo "Generating app key..."
php artisan key:generate --force || true

echo "Clearing ALL cache..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo "Running migrations..."
php artisan migrate --force --seed

echo "Deploy script finished!"