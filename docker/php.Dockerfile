FROM php:8.2-fpm-alpine

ADD ./docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

RUN apk add --no-cache \
    rabbitmq-c-dev \
    linux-headers \
    libmnl-dev \
    php-sockets

RUN mkdir -p /var/www/html

ADD ./src/ /var/www/html

RUN docker-php-ext-install pdo pdo_mysql sockets

RUN chown -R laravel:laravel /var/www/html