FROM php:8.4.13-fpm

WORKDIR /var/www/html

RUN apt-get update && \
    apt-get install -y \
        git \
        curl \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        unzip \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
    && pecl install pcov \
    && docker-php-ext-enable pcov \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN { \
    echo ';; Strict PHP Configuration'; \
    echo 'error_reporting = E_ALL'; \
    echo 'display_startup_errors = On'; \
    echo 'display_errors = On'; \
    echo 'log_errors = On'; \
    echo 'error_log = /var/log/php_errors.log'; \
    echo 'zend.assertions = 1'; \
    echo 'assert.exception = 1'; \
    echo 'strict_types = 1'; \
    echo 'opcache.enable = 1'; \
    echo 'opcache.enable_cli = 1'; \
    echo 'opcache.validate_timestamps = 1'; \
    echo 'opcache.save_comments = 1'; \
    echo 'session.use_strict_mode = 1'; \
    echo 'pcov.enabled = 1'; \
    echo 'pcov.directory = /var/www/html'; \
} > /usr/local/etc/php/conf.d/strict.ini

COPY --from=composer:2.8.2 /usr/bin/composer /usr/bin/composer

COPY . .

RUN git config --global --add safe.directory /var/www/html

RUN composer install --no-scripts

EXPOSE 80
