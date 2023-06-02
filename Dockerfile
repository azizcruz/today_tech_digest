# Use the official PHP 7.4 image as base
FROM php:8.2-apache

# Set the working directory
WORKDIR /var/www/html

# Set up Laravel
COPY . /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libonig-dev \
    libxml2-dev \
    zip \
    curl

RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.1/install.sh
RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.1/install.sh | bash
RUN . ~/.bashrc

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath opcache

# Enable Apache modules
RUN a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the Apache virtual host file
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Enable the virtual host
RUN a2ensite 000-default

# Restart Apache
RUN service apache2 restart

# Set permissions for Laravel storage directory
RUN chown -R www-data:www-data /var/www/html/storage/
RUN chmod -R 775 /var/www/html/storage/

# Install Composer dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Generate application key
RUN php artisan key:generate

# Clear configuration cache
RUN php artisan config:clear

# Cache configuration, events, routes, and views
RUN php artisan config:cache
RUN php artisan event:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Set permissions for Laravel storage and sessions directories
RUN chown -R www-data:www-data /var/www/html/storage/
RUN chown -R www-data:www-data /var/www/html/bootstrap/cache/
RUN chmod -R 755 /var/www/html/storage/
RUN chmod -R 755 /var/www/html/bootstrap/cache/

