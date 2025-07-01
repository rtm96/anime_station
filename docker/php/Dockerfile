FROM php:8.2-fpm

RUN apt-get update \
  && apt-get install -y libpq-dev zlib1g-dev unzip git \
  && docker-php-ext-install pdo_pgsql pgsql

# Composer
RUN php -r "copy('https://getcomposer.org/installer','composer-setup.php');" \
  && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
  && rm composer-setup.php

WORKDIR /var/www
