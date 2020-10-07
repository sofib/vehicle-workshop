FROM php:7.4-alpine

RUN curl --silent --show-error https://getcomposer.org/installer | php && mv composer.phar /usr/bin/composer

RUN mkdir /var/opt/workshop

WORKDIR /var/opt/workshop

ADD src ./src
ADD composer.json .
# ADD composer.lock .

RUN composer install

ENTRYPOINT [ "php", "cli.php" ]
