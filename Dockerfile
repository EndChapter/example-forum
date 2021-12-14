# For development, not deployment
# Referred to: https://dev.to/jackmiras/laravel-with-php7-4-in-an-alpine-container-3jk6
FROM postgres:14.1-alpine3.15

ENV POSTGRES_PASSWORD 1234
ENV POSTGRES_DB example_forum

WORKDIR /var/www/html/

# Essentials
RUN echo "UTC" > /etc/timezone
RUN apk add --no-cache zip unzip curl sqlite supervisor

# Installing bash
RUN apk add bash
RUN sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd

RUN apk add --no-cache \
nodejs \
npm \
php8 \
php8-common \
php8-pdo \
php8-opcache \
php8-zip \
php8-phar \
php8-iconv \
php8-cli \
php8-curl \
php8-openssl \
php8-mbstring \
php8-tokenizer \
php8-fileinfo \
php8-json \
php8-xml \
php8-xmlwriter \
php8-simplexml \
php8-dom \
php8-pgsql \
php8-pdo_pgsql \
php8-pdo_sqlite \
php8-tokenizer \
php8-pecl-redis

RUN ln -s /usr/bin/php8 /usr/bin/php

# Installing composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php

# Configure PHP
RUN mkdir -p /run/php/
RUN touch /run/php/php8.0-fpm.pid

COPY .docker/php.ini-production /etc/php8/php.ini

# Building process
COPY . .
RUN composer install --no-dev
RUN chown -R nobody:nobody /var/www/html/storage

EXPOSE 80
CMD ["postgres"]
#And yes I can use containers for development with vscode
