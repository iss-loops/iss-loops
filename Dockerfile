# Usar FrankenPHP con PHP 8.2
FROM dunglas/frankenphp:php8.2-bookworm

# Instalar extensiones PHP requeridas
RUN install-php-extensions \
    intl \
    zip \
    pdo_mysql \
    redis \
    opcache \
    gd \
    exif \
    bcmath

# ===== INSTALAR COMPOSER =====
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar Node.js 20
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# Configurar directorio de trabajo
WORKDIR /app

# Copiar composer files primero
COPY composer.json composer.lock ./

# Instalar dependencias PHP (sin plugins para evitar warnings)
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --no-scripts \
    --no-plugins

# Copiar package files
COPY package.json package-lock.json ./

# Instalar dependencias npm
RUN npm ci

# Copiar resto de la aplicación
COPY . .

# Post-autoload scripts de Composer (ahora que tenemos todos los archivos)
RUN COMPOSER_ALLOW_SUPERUSER=1 composer dump-autoload --optimize

# Build assets con Vite
RUN npm run build

# Limpiar node_modules para reducir tamaño
RUN rm -rf node_modules

# Crear directorios y permisos
RUN mkdir -p storage/framework/{sessions,views,cache,testing} storage/logs bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache

# Exponer puerto
EXPOSE 8000

# Comando de inicio
CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
