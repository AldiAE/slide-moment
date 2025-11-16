# Menggunakan base image PHP FPM Alpine yang stabil
FROM php:8.2-fpm-alpine

# [1/9] Instal Composer secara global
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# [2/9] Instal SEMUA dependensi sistem yang dibutuhkan:
# Memastikan semua library C ada untuk kompilasi ekstensi
RUN apk update && \
    apk add --no-cache git openssh-client linux-headers autoconf build-base make postgresql-dev

# [3/9] Instal EKSTENSI PHP Wajib
# sockets (Octane) dan pdo_pgsql (PostgreSQL)
RUN docker-php-ext-install sockets pdo_pgsql

# [4/9] Atur direktori kerja
WORKDIR /app

# [5/9] Salin source code Anda
COPY . /app

# [6/9] Instal dependensi Composer
RUN composer install --optimize-autoloader --no-scripts --no-interaction --no-dev

# [7/9] Set Izin Tulis
RUN chmod -R 777 storage bootstrap/cache

# [8/9] Hapus Cache Aplikasi (FIX: Hanya membersihkan cache berbasis file)
# HINDARI: optimize:clear, cache:clear, dan migrate (yang memicu koneksi database yang gagal)
RUN php artisan view:clear && \
    php artisan route:clear && \
    php artisan config:clear

# [9/9] Start Command Laravel Serve Sederhana
# Gunakan 'php artisan serve' jika Anda ingin menghindari masalah RoadRunner/Octane
# Jika Anda yakin dengan Octane, gunakan: CMD ["php", "artisan", "octane:start", "--server=roadrunner", "--host=0.0.0.0", "--port=8000"]
EXPOSE 8080
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080", "--no-reload"]
