# Menggunakan base image PHP FPM Alpine yang stabil
FROM php:8.2-fpm-alpine

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apk update && \
    apk add --no-cache git openssh-client linux-headers autoconf build-base make postgresql-dev postgresql-client

RUN docker-php-ext-install sockets pdo pdo_pgsql

WORKDIR /app
COPY . /app

RUN composer install --optimize-autoloader --no-scripts --no-interaction --no-dev

RUN chmod -R 777 storage bootstrap/cache

# Bersihkan cache file
RUN rm -f bootstrap/cache/*.php

# Default PORT (fallback) — Railway akan override
ENV PORT=8000

EXPOSE 8000

# Wajib pakai sh -c agar ${PORT} terbaca
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT}"]
