#!/usr/bin/env bash

echo "Running composer"
composer global require hirak/prestissimo
composer install --no-dev --optimize-autoloader --working-dir=/var/www/html

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Linking storage..."
php artisan storage:link

echo "Building frontend assets..."
npm install --prefix=/var/www/html
npm run production --prefix=/var/www/html

echo "Running migrations..."
php artisan migrate --force

echo "Deployment complete!"
