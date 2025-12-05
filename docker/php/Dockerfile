FROM php:8.2-fpm

# Configurar zona horaria
ENV TZ=America/Mexico_City
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    nano \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configurar extensión GD (necesaria para Filament + imágenes)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Instalar extensiones PHP necesarias para Laravel 12 + Filament
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    xml \
    zip \
    bcmath \
    intl \
    opcache

# Instalar Redis desde PECL
RUN pecl install redis && docker-php-ext-enable redis

# Configurar OPcache para producción
RUN { \
    echo 'opcache.enable=1'; \
    echo 'opcache.memory_consumption=256'; \
    echo 'opcache.interned_strings_buffer=16'; \
    echo 'opcache.max_accelerated_files=10000'; \
    echo 'opcache.revalidate_freq=2'; \
    echo 'opcache.fast_shutdown=1'; \
} > /usr/local/etc/php/conf.d/opcache.ini

# Configurar PHP para producción
RUN { \
    echo 'memory_limit=512M'; \
    echo 'upload_max_filesize=50M'; \
    echo 'post_max_size=50M'; \
    echo 'max_execution_time=300'; \
} > /usr/local/etc/php/conf.d/custom.ini

# Instalar Composer 2
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configurar directorio de trabajo
WORKDIR /var/www

# Cambiar permisos para www-data
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# Cambiar usuario a www-data
USER www-data

# Exponer puerto PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]