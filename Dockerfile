FROM php:8.2-apache

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    curl \
    ca-certificates \
    gnupg \
    netcat-traditional \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP
RUN docker-php-ext-install pdo_mysql mysqli mbstring exif pcntl bcmath gd zip

#Instalar XDebug
#RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

#COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Configurar Apache
RUN a2enmod rewrite
COPY apache-virtualhost.conf /etc/apache2/sites-available/000-default.conf

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Directorio de trabajo
WORKDIR /var/www/html

# Copiar el archivo de configuración de PHP
COPY php.ini /usr/local/etc/php/

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html

# Exponer puerto 80
EXPOSE 80