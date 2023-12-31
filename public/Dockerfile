# Use PHP 8.2 with Apache as the base image
FROM php:8.2-apache

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set up Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get update && apt-get -y install nodejs 

# Set working directory to /var/www
WORKDIR /var/www

# Copy application code
COPY . /var/www/html

# Modify php.ini settings for file uploads
RUN touch /usr/local/etc/php/conf.d/uploads.ini \
    && echo "upload_max_filesize = 10M;" >> /usr/local/etc/php/conf.d/uploads.ini

# Install Composer dependencies
RUN composer install

# Install NPM dependencies
RUN npm install

# Serve the application
CMD php artisan migrate --force && php artisan storage:link && php artisan serve --host=0.0.0.0 --port=$PORT
