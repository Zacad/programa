# docker/php-fpm/Dockerfile

FROM php:8-fpm-alpine
COPY wait-for-it.sh /usr/bin/wait-for-it
RUN chmod +x /usr/bin/wait-for-it
RUN apk --update --no-cache add git bash
RUN docker-php-ext-install pdo_mysql
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
CMD   composer self-update; composer create-project symfony/website-skeleton . ; composer update ; wait-for-it database:3306 -- bin/console doctrine:migrations:migrate ;  php-fpm
EXPOSE 9000
