FROM php:7.4.0-fpm

LABEL maintainer="apolo96 - andresfpvclap@gmail.com"

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    default-mysql-client \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    zlib1g-dev \
    libzip-dev \
    locales \
    jpegoptim optipng pngquant gifsicle \
    vim \
    nginx \
    supervisor \
    apt-utils \
    curl

# Install php extensions
RUN docker-php-ext-configure zip --with-libzip
RUN docker-php-ext-install pdo_mysql zip exif pcntl bcmath
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Install php redis
RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

# Install nodejs
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -
RUN apt-get install -y nodejs

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && echo "daemon off;" >> /etc/nginx/nginx.conf

# Copy config services file
COPY services-worker.conf /etc/supervisor/conf.d
COPY nginx/default /etc/nginx/sites-enabled/default

EXPOSE 80

# Set working directory
WORKDIR /var/www/html/

# Start php-fpm and nginx server
CMD ["/usr/bin/supervisord","-c","/etc/supervisor/conf.d/services-worker.conf","-n"]
