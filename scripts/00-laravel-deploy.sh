#!/usr/bin/env bash

# Переменные для логирования
PHP_FPM_LOG="/var/log/php-fpm/error.log"
STORAGE_BACKUP="/var/www/storage_backup"

echo "Starting deployment..."

# 1. Резервное копирование папки storage перед деплоем
echo "Backing up storage folder..."
mkdir -p $STORAGE_BACKUP
if [ -d "/var/www/html/storage/app/public" ]; then
    cp -r /var/www/html/storage/app/public $STORAGE_BACKUP/public
    echo "Storage backup completed."
else
    echo "Storage directory not found, skipping backup."
fi

# 2. Composer для установки PHP-зависимостей
echo "Running composer..."
composer global require hirak/prestissimo
composer install --no-dev --optimize-autoloader --working-dir=/var/www/html

# 3. Кэширование конфигураций Laravel
echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

# 4. Проверка и перезапуск PHP-FPM
echo "Restarting PHP-FPM service..."
if ! systemctl is-active --quiet php-fpm; then
    echo "PHP-FPM is not running. Starting PHP-FPM..."
    sudo systemctl start php-fpm
else
    echo "PHP-FPM is running. Restarting PHP-FPM..."
    sudo systemctl restart php-fpm
fi

# Проверка наличия сокета
echo "Ensuring PHP-FPM socket directory exists..."
sudo mkdir -p /var/run/php/
sudo chown www-data:www-data /var/run/php/

# Логирование состояния PHP-FPM
echo "Checking PHP-FPM logs..."
if [ -f "$PHP_FPM_LOG" ]; then
    sudo tail -n 20 "$PHP_FPM_LOG"
else
    echo "PHP-FPM log file not found."
fi

# 5. Перезапуск Nginx
echo "Restarting Nginx service..."
sudo systemctl restart nginx

# 6. Установка прав на папки
echo "Setting correct permissions for storage..."
chmod -R 775 storage
chmod -R 775 public/storage
chown -R www-data:www-data storage
chown -R www-data:www-data public/storage

# 7. Восстановление storage после деплоя
echo "Restoring storage folder..."
if [ -d "$STORAGE_BACKUP/public" ]; then
    cp -r $STORAGE_BACKUP/public /var/www/html/storage/app/public
    echo "Storage restored successfully."
else
    echo "No storage backup found, skipping restore."
fi

# 8. Создание симлинков для storage
echo "Linking storage..."
php artisan storage:link

# 9. Установка Node.js зависимостей и сборка фронтенда
echo "Building frontend assets..."
npm install --prefix=/var/www/html
npm run production --prefix=/var/www/html

# 10. Выполнение миграций
echo "Running migrations..."
php artisan migrate --force

# 11. Проверка обновлений системы
echo "Updating system packages..."
sudo apt update && sudo apt upgrade -y

echo "Deployment complete!"
