FROM php:8-apache

RUN apt-get update && apt-get install -y \
    zip \
    unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN pecl install xdebug \
  && docker-php-ext-enable xdebug
COPY ./xdebug.ini "${PHP_INI_DIR}/conf.d"

RUN a2enmod rewrite

RUN apt-get install -y libzip-dev zip && docker-php-ext-install zip