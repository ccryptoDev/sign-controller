# Use php:8-fpm-alpine as the base image
FROM php:8-fpm-alpine

# Set arguments for UID and GID
ARG UID
ARG GID

# Set environment variables for UID and GID
ENV UID=${UID}
ENV GID=${GID}

# Create directory for web content
RUN mkdir -p /var/www/html

WORKDIR /var/www/html

# Install Composer (if not already installed)
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Remove the dialout group (unused in this context)
# MacOS staff group's gid is 20, so is the dialout group in alpine linux. We're not using it, let's just remove it.
RUN delgroup dialout

# Add a system group 'laravel' with the specified GID
# Add a system user 'laravel' to the 'laravel' group with the specified UID
RUN addgroup -g ${GID} --system laravel
RUN adduser -G laravel --system -D -s /bin/sh -u ${UID} laravel

# Set PHP options: Increase maximum POST size and upload file size
RUN echo "post_max_size = 20M" >> /usr/local/etc/php/php.ini
RUN echo "upload_max_filesize = 20M" >> /usr/local/etc/php/php.ini

# Modify the PHP-FPM configuration to use the 'laravel' user
RUN sed -i "s/user = www-data/user = laravel/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = laravel/g" /usr/local/etc/php-fpm.d/www.conf
RUN echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf

# Install PHP extensions: pdo, pdo_mysql, and redis
RUN docker-php-ext-install pdo pdo_mysql

RUN mkdir -p /usr/src/php/ext/redis \
    && curl -L https://github.com/phpredis/phpredis/archive/5.3.4.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
    && echo 'redis' >> /usr/src/php-available-exts \
    && docker-php-ext-install redis
    
# Switch to 'laravel' user
USER laravel

# Set default command for PHP-FPM
CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]