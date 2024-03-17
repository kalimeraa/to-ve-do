FROM php:8.2-fpm

RUN mkdir -p /var/www/server/vendor

WORKDIR /var/www/server

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN pecl install -o -f msgpack-2.1.2 \
    &&  rm -rf /tmp/pear \
    && docker-php-ext-enable msgpack

RUN pecl install -o -f igbinary-3.2.1 \
    &&  rm -rf /tmp/pear \
    && docker-php-ext-enable igbinary

RUN pecl install xdebug; \
    docker-php-ext-enable xdebug
    
RUN apt-get update \
    # Install supervisord
    && apt-get install -y build-essential \
    && apt-get install -y supervisor \
    && apt-get install -y procps \
    telnet \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    && apt-get install -y libpq5 libpq-dev \
    && apt-get install -y libzip-dev \
    && apt-get install -y zip \
    && apt-get install -y libffi-dev \
    && apt-get install -y libxslt-dev \
    && apt-get install -y openssl \
    && docker-php-ext-install calendar \
    && docker-php-ext-install exif \
    && docker-php-ext-install gettext \
    && docker-php-ext-install pdo_pgsql pgsql \
    && docker-php-ext-install pdo_mysql mysqli \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install opcache \
    && docker-php-ext-install shmop sockets sysvmsg sysvsem sysvshm xsl\
    && docker-php-ext-install zip \
    && docker-php-ext-configure ffi --with-ffi \
    && docker-php-ext-install ffi \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && apt-get autoremove --purge -y libpq-dev \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV COMPOSER_ALLOW_SUPERUSER=1
# Copy existing application directory contents
COPY --chown=www-data:www-data ./server/ /var/www/server

RUN composer install 

EXPOSE 9000

CMD ["./build.sh"]
