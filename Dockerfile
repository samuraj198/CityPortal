# Используем официальный образ с PHP-FPM и Nginx
FROM richarvey/nginx-php-fpm:1.7.2

# Устанавливаем зависимости для Laravel и Node.js
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Копируем проект в контейнер
COPY . /var/www/html

# Устанавливаем зависимости PHP с помощью Composer
WORKDIR /var/www/html
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Устанавливаем зависимости JavaScript (npm)
RUN npm install

# Сборка фронтенда для продакшн (если у вас есть команда production в package.json)
RUN npm run production

# Устанавливаем права для директорий
RUN chown -R www-data:www-data /var/www/html && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Настройка переменных окружения Laravel
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr

# Настроим каталог для публичного доступа
ENV WEBROOT=/var/www/html/public

# Копируем конфигурацию Nginx
COPY ./conf/nginx/nginx-site.conf /etc/nginx/conf.d/default.conf

# Запуск Nginx и PHP-FPM
CMD ["/start.sh"]
