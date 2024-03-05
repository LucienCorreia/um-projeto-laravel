FROM composer AS builder

WORKDIR /app/

COPY ./ /app/

RUN composer install --optimize-autoloader --no-dev

FROM php:8.3

COPY --from=builder /app /var/www

# install system dependencies
RUN apt-get update && apt-get install -y \
		libfreetype-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
        unzip \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd \
    && curl -sLS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer \
    && apt-get update \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# set work directory
WORKDIR /var/www

# set permissions for Laravel application
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# expose PHP port and start FPM service
EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
