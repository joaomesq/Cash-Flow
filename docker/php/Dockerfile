FROM php:8.2-fpm

#instalar dependencias do sistema
RUN apt-get update && apt-get install -y \
    zip unzip git curl \
    libpng-dev libonig-dev libxml2-dev libzip-dev \
 && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

 #Instalar composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#Diretório da aplicação
WORKDIR /var/www

#permissões
COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
