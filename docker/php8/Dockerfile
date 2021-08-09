FROM php:8.0-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential

# Install extensions
RUN docker-php-ext-install pdo_mysql

# Copy existing application directory contents
COPY . /var/www
