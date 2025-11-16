# Gunakan base image PHP FPM resmi (misalnya PHP 8.2 FPM Alpine untuk efisiensi)
FROM php:8.2-fpm-alpine

# Instal dependensi sistem yang dibutuhkan (Git, dll.)
RUN apk update && \
    apk add git openssh-client

# INSTAL EKSTENSI SOCKETS PHP (Wajib untuk RoadRunner)
# Perintah ini akan selalu berhasil pada image Docker resmi
RUN docker-php-ext-install sockets

# Atur direktori kerja
WORKDIR /app

# Salin source code Anda ke dalam container
COPY . /app

# Instal dependensi Composer (Sekarang sockets sudah ada, instalasi akan berhasil)
# '--no-scripts' dan '--no-interaction' dari command Anda sudah bagus
RUN composer install --optimize-autoloader --no-scripts --no-interaction

# Set Izin Tulis untuk folder storage (diperlukan untuk upload)
RUN chmod -R 777 storage bootstrap/cache

# Expose port (opsional, karena Octane akan menjalankannya)
EXPOSE 8000

# Set Start Command untuk Octane
# Perhatikan: Sesuaikan port ini jika Railway mengharuskan port yang berbeda di container.
CMD ["php", "artisan", "octane:start", "--server=roadrunner", "--host=0.0.0.0", "--port=8000"]
