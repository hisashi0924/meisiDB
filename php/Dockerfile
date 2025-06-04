FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

COPY ./php.ini /usr/local/etc/php/

WORKDIR /var/www/html

