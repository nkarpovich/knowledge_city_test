FROM php:8.1-apache
RUN docker-php-ext-install pdo && docker-php-ext-enable pdo
RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql
RUN a2enmod rewrite && service apache2 restart
RUN apt-get update && apt-get upgrade -y