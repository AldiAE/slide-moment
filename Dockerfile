# Menggunakan base image PHP FPM Alpine yang ringan dan stabil
FROM php:8.2-fpm-alpine

# [1/9] Instal Composer secara global
# Ini memastikan perintah 'composer' tersedia untuk langkah berikutnya
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# [2/9] Instal SEMUA dependensi sistem yang dibutuhkan:
# - git, openssh-client: Untuk Octane/Composer/Git.
# - linux-headers, build-base, make: Untuk kompilasi ekstensi.
# - postgresql-dev: Untuk kompilasi ekstensi pdo_pgsql.
RUN apk update && \
    apk add --no-cache git openssh-client linux-headers autoconf build-base make postgresql-dev

# [3/9] Instal EKSTENSI PHP Wajib
# - sockets: Wajib untuk RoadRunner/Octane.
# - pdo_pgsql: Wajib untuk koneksi database PostgreSQL.
# Perintah ini akan berhasil karena dependensi di atas sudah terinstal.
RUN docker-php-ext-install sockets pdo_pgsql

# [4/9] Atur direktori kerja (root proyek Anda di container)
WORKDIR /app

# [5/9] Salin source code Anda ke dalam container
# Ini harus dilakukan sebelum menjalankan 'composer install' dan 'chmod'
COPY . /app

# [6/9] Instal dependensi Composer
# Menggunakan composer.lock yang sudah diupdate (yang sudah fix SIGINT)
RUN composer install --optimize-autoloader --no-scripts --no-interaction --no-dev

# [7/9] Set Izin Tulis
# Memberikan izin mutlak ke folder storage (wajib untuk Volume Mount dan upload)
RUN chmod -R 777 storage bootstrap/cache

# [8/9] Expose Port
# Memberi tahu Docker bahwa port 8000 akan menerima traffic
EXPOSE 8000

# [9/9] Start Command Octane
# Menjalankan RoadRunner. Pastikan host 0.0.0.0 agar dapat diakses dari luar container
CMD ["php", "artisan", "octane:start", "--server=roadrunner", "--host=0.0.0.0", "--port=8000"]
