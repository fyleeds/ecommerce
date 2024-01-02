
FROM php:8.1-apache

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo_mysql intl

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php && \
    mv composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer && \
    rm composer-setup.php

RUN apt update && apt install -yqq nodejs npm

COPY docker . /var/www/

COPY  docker/apache-config.conf /etc/apache2/sites-available/ecommerce.conf

COPY docker/wait-for-it.sh /usr/bin/wait-for-it

RUN chmod +x /usr/bin/wait-for-it

RUN a2dissite 000-default && a2ensite ecommerce

# Set permissions for the Symfony log directory
RUN mkdir -p /var/www/var/log \
    && chown -R www-data:www-data /var/www/var \
    && chmod -R 755 /var/www/var

# Install composer dependencies and run npm build
RUN cd /var/www && \
    composer install && \
    npm install --force && \
    npm run build

WORKDIR /var/www/

ENTRYPOINT ["bash","./docker/docker.sh"]

EXPOSE 80
