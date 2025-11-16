FROM php:8.2-fpm-alpine

# Menginstal dependensi sistem umum (Git, dll.)
RUN apk update && \
    apk add git openssh-client

# PERBAIKAN PENTING: Instal linux-headers untuk kompilasi sockets
# Tambahkan 'linux-headers' dan 'make' untuk memastikan semua alat kompilasi ada
RUN apk add --no-cache linux-headers autoconf build-base make && \
    docker-php-ext-install sockets && \
    # Hapus paket build tools yang tidak diperlukan setelah kompilasi selesai
    apk del linux-headers autoconf build-base make

# Atur direktori kerja
WORKDIR /app

# Salin source code Anda ke dalam container
COPY . /app

# Instal dependensi Composer
RUN composer install --optimize-autoloader --no-scripts --no-interaction

# Set Izin Tulis
RUN chmod -R 777 storage bootstrap/cache

# Set Start Command untuk Octane
CMD ["php", "artisan", "octane:start", "--server=roadrunner", "--host=0.0.0.0", "--port=8000"]
