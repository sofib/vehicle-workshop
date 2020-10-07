FROM composer:1.7 AS composer

FROM php:7.4-alpine

COPY --from=composer /usr/bin/composer /usr/bin/composer

# Composer requirements
ARG COMPOSER_AUTH='{}'
ENV COMPOSER_AUTH=${COMPOSER_AUTH}

RUN addgroup -S app && adduser -S -g app app && \
    mkdir -p /home/app

RUN apk add --no-cache git sqlite

WORKDIR /home/app

USER app

COPY composer.json .

#RUN [[ -f composer.lock || -f composer.json ]] && composer install --no-dev
RUN [[ -f composer.lock || -f composer.json ]] && composer install
#RUN composer update --no-dev

USER root

# Cleanup
RUN apk del git

USER app
