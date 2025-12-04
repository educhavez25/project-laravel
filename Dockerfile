FROM richarvey/nginx-php-fpm:latest

# 1. Copiar archivos
COPY . .

# 2. Instalar librerías
RUN composer install --no-dev --optimize-autoloader

# 3. Configuraciones
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr
ENV COMPOSER_ALLOW_SUPERUSER 1

# 4. ARRANQUE AUTOMÁTICO CON TODO INCLUIDO:
# - migrate --force: Crea las tablas si no existen.
# - db:seed --force: Llena la base de datos (¡Soluciona tu problema de datos!).
# - optimize: Limpia y reconstruye la caché de rutas (¡Soluciona tu error 404!).
CMD ["/bin/sh", "-c", "php artisan migrate --force && php artisan db:seed --force && php artisan optimize && /start.sh"]