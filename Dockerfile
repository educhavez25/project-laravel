# Usamos PHP con Apache (Soluciona el error 404 de rutas)
FROM php:8.2-apache

# 1. Instalar dependencias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql zip

# 2. Habilitar Mod Rewrite (Fundamental para Laravel en Apache)
RUN a2enmod rewrite

# 3. Configurar Apache para apuntar a /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 4. Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Copiar archivos
WORKDIR /var/www/html
COPY . .

# 6. Instalar librerías
RUN composer install --optimize-autoloader

# 7. Permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 8. COMANDO FINAL (CORREGIDO):
# Ya NO ejecutamos 'db:seed' para evitar el error de duplicados.
# Solo migramos, limpiamos caché y arrancamos el servidor.
CMD php artisan migrate --force && php artisan config:clear && php artisan route:clear && apache2-foreground