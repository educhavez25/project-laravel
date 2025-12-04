FROM richarvey/nginx-php-fpm:latest

COPY . .

# Configuración para que Laravel corra bien
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Permisos
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]