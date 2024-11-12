# Menggunakan image PHP-FPM sebagai dasar
FROM php:8.0-fpm

# Install NGINX
RUN apt-get update && \
    apt-get install -y nginx && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Salin konfigurasi NGINX yang sudah dikustomisasi
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Salin folder "kitadonor" ke dalam folder HTML NGINX
COPY kitadonor /usr/share/nginx/html/kitadonor

# Atur working directory ke /usr/share/nginx/html/kitadonor
WORKDIR /usr/share/nginx/html/kitadonor

# Beri izin pada folder agar dapat diakses
RUN chown -R www-data:www-data /usr/share/nginx/html/kitadonor && \
    chmod -R 755 /usr/share/nginx/html/kitadonor

# Expose port 80 untuk NGINX
EXPOSE 80

# Perintah untuk menjalankan PHP-FPM dan NGINX secara bersamaan
CMD ["sh", "-c", "service nginx start && php-fpm"]