FROM php:7.4.19-apache

USER root

# Set working directory
WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libldap2-dev \
    libpng-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    curl \
    nano \
    zip \
    unzip

# Copy existing application directory contents
COPY . /var/www/html
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl gd bcmath zip ldap mysqli

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install
