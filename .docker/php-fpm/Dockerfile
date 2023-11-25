FROM php:8.3-rc-fpm
RUN echo "Europe/Berlin" > /etc/timezone && dpkg-reconfigure -f noninteractive tzdata

ENV APACHE_DOCUMENT_ROOT /var/www/

RUN  apt-get update && apt-get install -y ca-certificates gnupg

RUN apt-get update && apt-get install -y libzip-dev zip && docker-php-ext-install zip

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN apt-get install -y libtidy-dev && docker-php-ext-install tidy && docker-php-ext-enable tidy

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer