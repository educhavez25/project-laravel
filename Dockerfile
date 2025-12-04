FROM richarvey/nginx-php-fpm:latest

# 1. Copiamos tus archivos
COPY . .

# 2. INSTALACIÓN (Equivalente a la primera parte de tu comando en Railway)
# Forzamos la descarga de 'vendor' aquí para que no falle luego.
RUN composer install --no-dev --optimize-autoloader

# 3. CONFIGURACIÓN
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr
ENV COMPOSER_ALLOW_SUPERUSER 1

# 4. ARRANQUE AUTOMÁTICO (Equivalente a la última parte de tu comando)
# Aquí le decimos: "Migra la base de datos Y LUEGO inicia el servidor"
CMD ["/bin/sh", "-c", "php artisan migrate --force && php artisan config:clear && /start.sh"]