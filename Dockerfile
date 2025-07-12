FROM php:8.2-fpm

# Update and install system packages
RUN apt-get update && apt-get upgrade -y && apt-get install -y \
    apt-utils \
    nano \
    wget \
    dialog \
    vim \
    build-essential \
    git \
    curl \
    libcurl4 \
    libcurl4-openssl-dev \
    zlib1g-dev \
    libzip-dev \
    zip \
    libbz2-dev \
    locales \
    libmcrypt-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev

# Install PHP extensions
RUN docker-php-ext-install \
    exif \
    pcntl \
    bcmath \
    ctype \
    curl \
    zip \
    pdo \
    pdo_pgsql

# Set working directory
WORKDIR /app

# Copy project files
COPY . /app

# Install Composer and dependencies
COPY --from=composer:2.6.6 /usr/bin/composer /usr/bin/composer
RUN composer install --ignore-platform-req=ext-gd

# Expose port
EXPOSE 80

# Start Laravel dev server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]