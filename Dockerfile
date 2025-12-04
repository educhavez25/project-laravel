FROM php:8.2-apache

# 1. Instalar dependencias del sistema + NODEJS (Nuevo)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    git \
    gnupg \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_pgsql zip

# 2. Habilitar Mod Rewrite
RUN a2enmod rewrite

# 3. Configurar Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 4. Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Copiar archivos
WORKDIR /var/www/html
COPY . .

# 6. INSTALAR TODO (PHP + JS) Y COMPILAR (Nuevo)
RUN composer install --optimize-autoloader
RUN npm install
RUN npm run build

# 7. Permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 8. Arranque
CMD php artisan migrate --force && php artisan config:clear && php artisan route:clear && apache2-foreground