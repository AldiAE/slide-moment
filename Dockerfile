# Menggunakan base image PHP FPM Alpine yang stabil dan ringan
FROM php:8.2-fpm-alpine

# [1/11] Instal Composer secara global
# Menyalin Composer dari image resminya agar tersedia di /usr/local/bin
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# [2/11] Instal SEMUA dependensi sistem yang dibutuhkan:
# - git, openssh-client: Untuk Octane/Composer/Git.
# - linux-headers, build-base, make: Untuk kompilasi ekstensi.
# - postgresql-dev: Wajib untuk kompilasi ekstensi pdo_pgsql.
RUN apk update && \
    apk add --no-cache git openssh-client linux-headers autoconf build-base make postgresql-dev

# [3/11] Instal EKSTENSI PHP Wajib
# - sockets: Wajib untuk RoadRunner/Octane.
# - pdo_pgsql: Wajib untuk koneksi database PostgreSQL.
RUN docker-php-ext-install sockets pdo_pgsql

# [4/11] Atur direktori kerja (root proyek Anda di container)
WORKDIR /app

# [5/11] Salin source code Anda ke dalam container
COPY . /app

# [6/11] Instal dependensi Composer (Menggunakan lock file terbaru)
RUN composer install --optimize-autoloader --no-scripts --no-interaction --no-dev

# [7/11] Set Izin Tulis
# Memberikan izin mutlak ke folder storage dan cache
RUN chmod -R 777 storage bootstrap/cache

# [8/11] Hapus Cache Aplikasi (PENTING untuk mengatasi error SQLite/SIGINT)
# Menambahkan CACHE_DRIVER=file secara sementara agar perintah ini tidak mencoba koneksi database
RUN DB_CONNECTION=pgsql CACHE_DRIVER=file php artisan optimize:clear && \
    php artisan view:clear && \
    php artisan route:clear && \
    php artisan config:clear

# [9/11] Jalankan Migrasi Database (Opsional, tergantung kebutuhan Anda)
# Anda bisa menghapus baris ini jika Anda lebih suka menjalankan migrasi melalui 'railway run'
RUN php artisan migrate --force

# [10/11] Expose Port
# Port yang akan didengarkan oleh RoadRunner
EXPOSE 8000

# [11/11] Start Command Octane
# Menjalankan RoadRunner di port yang diekspos
CMD ["php", "artisan", "octane:start", "--server=roadrunner", "--host=0.0.0.0", "--port=8000"]
