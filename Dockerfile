FROM nginx:1.25.1 as web-local
EXPOSE 8091
COPY .image/dev/nginx/ /etc/nginx/

FROM web-local as web-development
COPY --chown=nginx:nginx public /app/public

# APP
FROM php:8.3.8-fpm-alpine3.20 as os
RUN apk add --virtual .build-deps $PHPIZE_DEPS \
    && apk add \
    bash \
    vim \
    zip \
    openssl \
    curl \
    openssh \
    git \
    && apk del .build-deps $PHPIZE_DEPS \
    && docker-php-source delete \
ENV COMPOSER_HOME /.composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
HEALTHCHECK --interval=10s --timeout=3s --retries=3 CMD ["php-fpm-healthcheck"]
COPY .image/common/php/docker-healthcheck /usr/local/bin/php-fpm-healthcheck
COPY .image/common/php/healthcheck.conf /usr/local/etc/php-fpm.d/healthcheck.conf
COPY .image/common/php/php.ini $PHP_INI_DIR/php.ini

WORKDIR /app
EXPOSE 9000

FROM os as vendor-development
WORKDIR /build
COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --no-autoloader

FROM os as app-local
RUN apk add --virtual .build-deps $PHPIZE_DEPS \
    && apk add bash vim linux-headers libcurl \
    && apk del .build-deps $PHPIZE_DEPS \
    && docker-php-source delete \
    && install-php-extensions gd pdo_pgsql pgsql bcmath zip intl opcache imap pcntl gd apcu soap sockets xdebug \
    && apk add npm \
    && npm install yarn --global

COPY .image/dev/php/*.ini $PHP_INI_DIR/conf.d/
COPY .image/dev/php/php-fpm.conf /usr/local/etc/php-fpm.d/php-fpm.conf
