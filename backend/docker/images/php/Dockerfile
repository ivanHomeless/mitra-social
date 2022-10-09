FROM php:7.4-fpm

# Set working directory
WORKDIR /usr/share/nginx/mitra-social-backend.loc

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    supervisor \
    cron \
    jpegoptim \
    optipng \
    pngquant \
    webp \
    libpq-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
 && docker-php-ext-install  pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# get Supervisor configuration file
#COPY ./config/supervisor/laravel-worker.conf /etc/supervisor/conf.d/
#CMD service supervisor start

COPY --chown=www:www . /usr/share/nginx

USER www

EXPOSE 9000
