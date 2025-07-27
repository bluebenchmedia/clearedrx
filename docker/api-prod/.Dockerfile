FROM php:8.4-fpm

WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libssl-dev \
    libxml2-dev \
    zip \
    redis-server \
    unzip

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

#RUN pecl install redis
#
#RUN pecl install mongodb

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
#RUN docker-php-ext-enable redis
#RUN docker-php-ext-enable mongodb
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl
RUN install-php-extensions xdebug

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

COPY ./docker/api/dev.ini /usr/local/etc/php/conf.d/dev.ini
COPY ./docker/api/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/

USER root

RUN /usr/bin/composer install

EXPOSE 9000
