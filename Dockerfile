FROM php:7.2-fpm
RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer
RUN apt-get update -qq && apt-get install -y build-essential libxslt-dev libxml2-dev cmake
RUN apt-get update \
    && apt-get install -y \
    git \
    zip \
    unzip \
    vim
RUN apt-get install -y nodejs npm
RUN apt-get update -qq && apt-get install -y libpq-dev && docker-php-ext-install pdo_mysql pdo_pgsql
WORKDIR /var/www/html