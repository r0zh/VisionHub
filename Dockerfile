FROM serversideup/php:8.3-fpm-nginx
WORKDIR /var/www/html
COPY --chown=www-data:www-data . /var/www/html

# Change user to root to install system packages
USER root
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zlib1g-dev \
    libicu-dev \
    libzip-dev \
    g++ \
    nodejs \
    npm \
    w3m 
RUN docker-php-ext-install mbstring exif pcntl bcmath gd intl 

RUN composer install --no-dev --optimize-autoloader

RUN php artisan migrate:fresh
RUN php artisan db:seed
RUN php artisan storage:link
RUN php artisan config:cache
RUN php artisan key:generate
#RUN php artisan route:cache
RUN php artisan view:cache
RUN php artisan event:cache

# Install node packages and build assets
RUN npm install
RUN npm run build

USER www-data
