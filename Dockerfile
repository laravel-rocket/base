FROM php:8.3-apache

ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Set the Apache document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Update the default Apache site configuration
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update && apt-get install -y libssh2-1-dev
RUN a2enmod rewrite
RUN install-php-extensions @composer pdo_pgsql pdo_sqlsrv zip decimal gd ssh2 sockets

# Set environment variables
ENV APP_ENV=production \
    APP_DEBUG=false \
    APP_URL=http://localhost \
    APP_KEY="app_key"

# Copy the application
COPY . /var/www/html

# Set the working directory
WORKDIR /var/www/html

# Install Laravel
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# JWT cert
RUN php artisan jwt:generate-certs

# Expose port 80
EXPOSE 80

# Start the web server
CMD ["apache2-foreground"]
