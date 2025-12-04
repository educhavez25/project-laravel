# Usamos PHP con Apache (Más compatible con rutas de Laravel)
FROM php:8.2-apache

# 1. Instalar dependencias del sistema (Postgres, Zip, Git)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql zip

# 2. Habilitar "Mod Rewrite" (¡ESTO ARREGLA TUS RUTAS 404!)
# Permite que Apache lea el archivo .htaccess de Laravel
RUN a2enmod rewrite

# 3. Configurar Apache para que la carpeta pública sea la raíz
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 4. Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Copiar los archivos del proyecto
WORKDIR /var/www/html
COPY . .

# 6. Instalar librerías de Laravel (Sin --no-dev para que funcione Faker)
RUN composer install --optimize-autoloader

# 7. Dar permisos a Apache para escribir en storage y cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 8. COMANDO DE ARRANQUE:
# Migra, llena datos (Seed), limpia caché y arranca Apache
CMD php artisan migrate --force && php artisan db:seed --force && php artisan config:clear && php artisan route:clear && apache2-foreground