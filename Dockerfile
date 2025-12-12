# Usamos una imagen oficial de PHP estable
FROM php:8.4-cli

# Instalamos dependencias del sistema necesarias para Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd

# Instalamos Composer (el gestor de dependencias) dentro de la imagen
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definimos el directorio de trabajo
WORKDIR /var/www/html

# Copiamos solo los archivos de dependencias primero (para aprovechar la caché de Docker)
COPY composer.json composer.lock ./

# Instalamos las librerías de Laravel (sin dependencias de desarrollo para optimizar)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Ahora copiamos el resto del código de la aplicación
COPY . .

# Damos permisos a las carpetas de almacenamiento
RUN chown -R www-data:www-data storage bootstrap/cache

# Exponemos el puerto 8000
EXPOSE 8000

# Comando para iniciar el servidor
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]