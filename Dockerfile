# Use an official PHP runtime as a parent image
FROM php:8.0-fpm

# Set the working directory in the container
WORKDIR /var/www

# Install necessary extensions and tools
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Install Composer (PHP dependency manager)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the Laravel project files into the container
COPY . .

# Set appropriate permissions for the storage and cache directories
RUN chmod -R 777 /var/www/storage /var/www/bootstrap/cache

# Install Laravel dependencies with Composer
RUN composer install --no-dev --optimize-autoloader

# Expose port 80 to the outside world
EXPOSE 80

# Start the PHP-FPM server
CMD ["php-fpm"]
