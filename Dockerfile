FROM php:8.2-fpm-alpine

# [1/7] Instal dependensi sistem dan alat untuk kompilasi
RUN apk update && \
    apk add --no-cache git openssh-client linux-headers autoconf build-base make

# [2/7] Instal Composer (Baru Ditambahkan!)
# Ini adalah cara standar menginstal Composer di Docker
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# [3/7] Instal ekstensi Sockets PHP
RUN docker-php-ext-install sockets

# [4/7] Hapus paket build tools yang tidak diperlukan
RUN apk del linux-headers autoconf build-base make

# [5/7] Atur direktori kerja
WORKDIR /app

# [6/7] Salin source code Anda ke dalam container
COPY . /app

# [7/7] Instal dependensi Composer (Sekarang 'composer' sudah dikenali)
RUN composer install --optimize-autoloader --no-scripts --no-interaction

# ... (Lanjutkan dengan chmod, CMD, dll.)
