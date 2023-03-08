FROM php:8.1-fpm

USER root

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        libpq-dev \
        zip \
        curl \
        unzip \
    && docker-php-ext-configure gd \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && docker-php-ext-install exif \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pgsql \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-source delete \

RUN apt-get update && apt-get install -y nodejs npm

RUN npm install && npm run dev

COPY . /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#CMD ['chown', '-R www-data:www-data', '/var/www/html/']
#CMD ['chmod', '-R 755', '/var/www/html/']



EXPOSE 80 443
