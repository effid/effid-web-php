# Image de base apache multiarch
FROM php:7.1-apache

# Exposer les ports web
EXPOSE 80 443

# Repertoire de base pour le serveur web
WORKDIR /app

# Ancienne dependance
RUN apt-get update -qq && apt-get install -qy gnupg && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*


# PHP Extensions
RUN docker-php-ext-install -j$(nproc) opcache pdo_mysql mbstring mysqli

# Configuration PHP
COPY config/php.ini /usr/local/etc/php/conf.d/app.ini

# Apache configuration
COPY config/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY config/apache.conf /etc/apache2/conf-available/z-app.conf

# Copie code source
COPY . /app/

# Execution du serveur apache
RUN chown -R www-data:www-data /app
RUN chmod -R 755 /app
RUN a2enmod rewrite remoteip && a2enconf z-app
RUN service apache2 restart
