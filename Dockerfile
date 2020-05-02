FROM php:7.4-alpine

RUN curl --silent --show-error https://getcomposer.org/installer | php && mv composer.phar /usr/bin/composer

RUN mkdir /var/opt/workshop

WORKDIR /var/opt/workshop

ADD src ./src
ADD entrypoint/cli ./entrypoint
ADD composer.json .
ADD composer.lock .

RUN composer install

VOLUME [ "/var/opt/workshop/src" ]

ENTRYPOINT [ "php", "entrypoint/cli.php" ]
