# Menggunakan base image PHP FPM Alpine
FROM php:8.2-fpm-alpine

# [1/10] Instal Composer secara global
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# [2/10] Instal SEMUA dependensi sistem yang dibutuhkan:
# Memastikan semua library C ada untuk kompilasi ekstensi
RUN apk update && \
    apk add --no-cache git openssh-client linux-headers autoconf build-base make postgresql-dev

# [3/10] Instal EKSTENSI PHP Wajib
# sockets (Octane) dan pdo_pgsql (PostgreSQL)
RUN docker-php-ext-install sockets pdo_pgsql

# [4/10] Atur direktori kerja
WORKDIR /app

# [5/10] Salin source code Anda
COPY . /app

# [6/10] Instal dependensi Composer (Wajib ada Octane/RoadRunner di composer.lock)
RUN composer install --optimize-autoloader --no-scripts --no-interaction --no-dev

# [7/10] Set Izin Tulis
RUN chmod -R 777 storage bootstrap/cache

# [8/10] Hapus Cache Aplikasi (FIX: Hanya membersihkan cache berbasis file)
RUN php artisan view:clear && \
    php artisan route:clear && \
    php artisan config:clear

# [9/10] Expose Port 8080
EXPOSE 8080

# [10/10] Start Command Octane di Port 8080
# Menambahkan --no-reload agar Octane dapat menggunakan banyak worker (diatur via RR_WORKERS di Railway)
CMD ["php", "artisan", "octane:start", "--server=roadrunner", "--host=0.0.0.0", "--port=8080", "--no-reload"]
