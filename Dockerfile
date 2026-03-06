# Etapa base
FROM php:8.2-fpm

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev \
    zip libzip-dev npm nginx supervisor

# Extensões PHP necessárias
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Definindo diretório de trabalho
WORKDIR /var/www

# Copiando arquivos do Laravel
COPY . .

# Instalando dependências PHP
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Instalando dependências Node
RUN npm install

# Copiando start.sh e dando permissão
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Copiando configuração nginx
COPY docker/nginx/default.prod.conf /etc/nginx/conf.d/default.conf

# Expondo porta que o Render vai mapear
EXPOSE 80

# Comando de start
CMD ["/start.sh"]