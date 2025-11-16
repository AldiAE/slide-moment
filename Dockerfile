# Menggunakan base image PHP FPM Alpine yang stabil
# Menggunakan PHP 8.2 FPM Alpine
FROM php:8.2-fpm-alpine

# [1/10] Instal Composer secara global
# Menyalin Composer dari image resminya agar tersedia di /usr/local/bin
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# [2/10] Instal SEMUA dependensi sistem yang dibutuhkan:
# Memastikan semua library C (PostgreSQL, Linux Headers) ada untuk kompilasi ekstensi
RUN apk update && \
    apk add --no-cache git openssh-client linux-headers autoconf build-base make postgresql-dev

# [3/10] Instal EKSTENSI PHP Wajib
# - sockets: Wajib untuk RoadRunner/Octane.
# - pdo_pgsql: Wajib untuk koneksi database PostgreSQL.
RUN docker-php-ext-install sockets pdo_pgsql

# [4/10] Atur direktori kerja (root proyek Anda di container)
WORKDIR /app

# [5/10] Salin source code Anda ke dalam container
# Ini harus dilakukan sebelum menjalankan 'composer install'
COPY . /app

# [6/10] Instal dependensi Composer (Menggunakan lock file terbaru)
RUN composer install --optimize-autoloader --no-scripts --no-interaction --no-dev

# [7/10] Set Izin Tulis
# Memberikan izin mutlak ke folder storage
RUN chmod -R 777 storage bootstrap/cache

# [8/10] Hapus Cache Aplikasi
# Krusial untuk mengatasi error SIGINT/versioning yang persisten
RUN php artisan optimize:clear && \
    php artisan view:clear && \
    php artisan route:clear && \
    php artisan config:clear

# [9/10] Expose Port
# Port yang akan didengarkan oleh RoadRunner
EXPOSE 8000

# [10/10] Start Command Octane
# Menjalankan RoadRunner di port yang diekspos
CMD ["php", "artisan", "octane:start", "--server=roadrunner", "--host=0.0.0.0", "--port=8000"]
