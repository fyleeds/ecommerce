FROM php:8.1-apache

# Install PHP extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo pdo_mysql mysqli gd opcache intl zip calendar dom mbstring xsl && \
    a2enmod rewrite

# Install APCu
RUN pecl install apcu && docker-php-ext-enable apcu

# Install Composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm composer-setup.php

# Install additional packages
RUN apt update && apt install -yqq nodejs npm locales coreutils apt-utils git libicu-dev g++ libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev;

# Copy application source
COPY . /var/www/

# Configure Apache
COPY ./docker/apache-config.conf /etc/apache2/sites-available/ecommerce.conf
RUN a2dissite 000-default && a2ensite ecommerce

# Set permissions for the Symfony log directory
RUN mkdir -p /var/www/var/log 
# Install composer dependencies and run npm build

RUN cd /var/www && \
    touch .env && \
    echo "APP_ENV=dev" >> .env && \
    echo "APP_SECRET=92d36690c31f1efd2bb3f444bcee3a4c" >> .env && \
    echo "DATABASE_URL=\"mysql://root:rootpassword@db:3306/ecommercedev?serverVersion=5.7&charset=utf8mb4\"" >> .env


RUN cd /var/www && \
    composer install && \
    npm install --force && \
    npm run build 

RUN chown -R www-data:www-data /var/www/var && \
    chmod -R 755 /var/www/var

# Set the working directory
WORKDIR /var/www/

# Expose port 80
EXPOSE 80
