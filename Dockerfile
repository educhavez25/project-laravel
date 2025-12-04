FROM richarvey/nginx-php-fpm:latest

# 1. Copiar archivos
COPY . .

# 2. INSTALAR LIBRERÍAS (CORREGIDO)
# Quitamos el '--no-dev' para que se instale Faker y funcione el fake()
RUN composer install --optimize-autoloader

# 3. Configuraciones
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr
ENV COMPOSER_ALLOW_SUPERUSER 1

# 4. Arranque (Migraciones + Seeders + Cache)
CMD ["/bin/sh", "-c", "php artisan migrate --force && php artisan db:seed --force && php artisan optimize && /start.sh"]