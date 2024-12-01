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

# Установка прав на директории
echo "Setting permissions for storage..."
chmod -R 775 storage
chmod -R 775 public/storage
chown -R www-data:www-data storage
chown -R www-data:www-data public/storage

echo "Building frontend assets..."
npm install --prefix=/var/www/html
npm run production --prefix=/var/www/html

# Запуск или перезапуск PHP-FPM
echo "Restarting PHP-FPM service..."
sudo systemctl restart php-fpm

# Перезапуск Nginx (если требуется)
echo "Restarting Nginx service..."
sudo systemctl restart nginx

echo "Running migrations..."
php artisan migrate --force

echo "Deployment complete!"
