FROM php:7.4-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y libpng-dev libjpeg62-turbo-dev libfreetype6-dev libzip-dev zip unzip git curl libonig-dev
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8000
