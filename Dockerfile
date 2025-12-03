# Usar FrankenPHP con PHP 8.2 (oficial de Laravel)
FROM dunglas/frankenphp:php8.2-bookworm

# Instalar extensiones PHP requeridas por Filament y Laravel
RUN install-php-extensions \
    intl \
    zip \
    pdo_mysql \
    redis \
    opcache \
    gd \
    exif \
    bcmath

# Instalar Node.js 20 para compilar assets
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# Configurar directorio de trabajo
WORKDIR /app

# Copiar composer files primero (para aprovechar cache de Docker)
COPY composer.json composer.lock ./

# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copiar package files
COPY package.json package-lock.json ./

# Instalar dependencias de npm
RUN npm ci

# Copiar el resto de la aplicación
COPY . .

# Build de assets con Vite
RUN npm run build

# Eliminar node_modules para reducir tamaño
RUN rm -rf node_modules

# Crear directorios y permisos
RUN mkdir -p storage/framework/{sessions,views,cache,testing} storage/logs bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache

# Exponer puerto (Railway usa variable $PORT)
EXPOSE 8000

# Script de inicio
CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
