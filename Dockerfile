# Set the base image
FROM php:8.0-fpm

# Set working directory
WORKDIR /var/www

# Install necessary extensions
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the Laravel project files
COPY . .

# Install Laravel dependencies
RUN composer install

# Set permissions for storage and cache
RUN chmod -R 777 /var/www/storage /var/www/bootstrap/cache

# Expose the port the app will run on
EXPOSE 80

# Start the PHP FPM server
CMD ["php-fpm"]
