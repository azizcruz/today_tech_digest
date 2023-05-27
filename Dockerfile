# Use the official PHP 7.4 image as base
FROM php:8.2-apache

# Set the working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libonig-dev \
    libxml2-dev \
    zip \
    curl

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath opcache

# Enable Apache modules
RUN a2enmod rewrite

# Copy the Apache virtual host file
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Enable the virtual host
RUN a2ensite 000-default

# Restart Apache
RUN service apache2 restart

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set up Laravel
COPY . /var/www/html

# Set permissions for Laravel storage directory
RUN chown -R www-data:www-data /var/www/html/storage/
RUN chmod -R 665 /var/www/html/storage/


RUN composer install --optimize-autoloader --no-dev

# Generate application key
RUN php artisan key:generate

RUN php artisan config:clear
