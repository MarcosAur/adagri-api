FROM php:8.3-fpm

RUN apt update && apt install -y \
    git unzip libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
