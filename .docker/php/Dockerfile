FROM php:8-apache

RUN apt-get update
RUN apt-get install -y libpq-dev
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo pdo_pgsql pgsql
RUN a2enmod rewrite
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

RUN apt-get clean