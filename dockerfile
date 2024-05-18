# Dockerfile

# Use the last official PHP image as a parent image
FROM php:8.2-cli-alpine3.18

# Set the working directory to /app
WORKDIR /app

# Copy the current directory contents into the container at /app
COPY . /app

# Install any needed packages
RUN apt-get update && apt-get upgrade -y \
    git \
    unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install composer dependencies
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Expose port 8000 and start Laravel's development server
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

HEALTHCHECK --interval=30s --timeout=10s \
CMD curl -f http://localhost:3000/_health || exit 1

# Copia el código fuente de Laravel al contenedor
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Instala las extensiones PHP necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Habilita el módulo Apache mod_rewrite
RUN a2enmod rewrite
