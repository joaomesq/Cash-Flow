# ---------- PHP ----------
FROM php:8.2-fpm

# Instalar dependências
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libpq-dev \
    libzip-dev \
    nodejs \
    npm \
    nginx \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instalar composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Diretório da aplicação
WORKDIR /var/www

# Copiar arquivos
COPY . .

# Instalar dependências PHP
RUN composer install --no-dev --optimize-autoloader

# Instalar dependências Node
RUN npm install

# Build do Vite
RUN npm run build

# Permissões
RUN chown -R www-data:www-data /var/www

# Config nginx
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

EXPOSE 80

CMD service nginx start && php-fpm