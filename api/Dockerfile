# Base image
FROM php:8.3-fpm

WORKDIR /var/www/html

RUN usermod -u 1000 www-data

COPY composer.json composer.lock ./

RUN apt-get update -y
RUN apt-get install -y libzip-dev unzip 
RUN docker-php-ext-install zip pdo pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-scripts --no-autoloader

COPY --chown=www-data . .

RUN composer dump-autoload --optimize

RUN chown -R www-data:www-data /var/www/html/storage 
RUN chmod -R 775 /var/www/html/storage
RUN chmod -R 775 /var/www/html/bootstrap

EXPOSE 80

CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]