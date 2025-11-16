FROM php:8.2-fpm-alpine

# [1/9] Instal Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# [2/9] Instal SEMUA dependensi sistem yang dibutuhkan:
# - git, openssh-client: Untuk Octane/Composer/Git.
# - linux-headers, build-base, make: Untuk kompilasi.
# - postgresql-dev: UNTUK PDO_PGSQL (MEMPERBAIKI ERROR 'libpq-fe.h')
RUN apk update && \
    apk add --no-cache git openssh-client linux-headers autoconf build-base make postgresql-dev

# [3/9] Instal EKSTENSI PHP (Sekarang semua dependensi C sudah ada)
RUN docker-php-ext-install sockets pdo_pgsql

# [4/9] Hapus paket build tools yang tidak diperlukan
# RUN apk del linux-headers autoconf build-base make

# [5/9] Atur direktori kerja
WORKDIR /app

# [6/9] Salin source code Anda ke dalam container
COPY . /app

# [7/9] Instal dependensi Composer (Sekarang sockets dan pdo_pgsql sudah aktif)
RUN composer install --optimize-autoloader --no-scripts --no-interaction

# [8/9] Set Izin Tulis
RUN chmod -R 777 storage bootstrap/cache

# [9/9] Start Command Octane
CMD ["php", "artisan", "octane:start", "--server=roadrunner", "--host=0.0.0.0", "--port=8000"]
