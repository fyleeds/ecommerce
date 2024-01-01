
FROM php:8.1-apache

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo_pgsql intl

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php && \
    mv composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer && \
    rm composer-setup.php

RUN apt update && apt install -yqq nodejs npm

COPY . /var/www/

COPY  ./docker/apache-config.conf /etc/apache2/conf-available/custom-config.conf

RUN cd /var/www && \
    composer install && \
    npm install --force &&\
    npm run build
WORKDIR /var/www/

ENTRYPOINT ["bash","./docker/docker.sh"]

EXPOSE 80