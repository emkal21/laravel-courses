ARG PHP_VERSION

FROM php:${PHP_VERSION}-apache

# Install additional packages and PHP extensions
RUN apt update \
    && apt install -y libzip-dev git zip unzip \
    && docker-php-ext-install bcmath pdo_mysql zip \
    && docker-php-ext-enable bcmath pdo_mysql zip

# Update Apache virtual hosts to match new document root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable Apache2 mod_rewrite
RUN a2enmod rewrite
RUN service apache2 restart

# Set current working directory
WORKDIR /var/www/html

# Install Laravel and other dependencies
#COPY ../../../src/composer.json /var/www/html
#ENV COMPOSER_ALLOW_SUPERUSER=1
#RUN composer install

## Update Laravel .env file
#RUN cp .env.example .env
#RUN sed -ri -e 's!DB_HOST=127.0.0.1!DB_HOST=mysql!g' .env
#RUN sed -ri -e 's!DB_DATABASE=laravel!DB_DATABASE=${MYSQL_DATABASE}!g' .env
#RUN sed -ri -e 's!DB_USERNAME=root!DB_USERNAME=${MYSQL_USER}!g' .env
#RUN sed -ri -e 's!DB_PASSWORD=!DB_PASSWORD=${MYSQL_PASSWORD}!g' .env
#
## Generate Laravel application key
#RUN php artisan key:generate