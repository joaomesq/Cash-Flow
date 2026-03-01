# Stage 1: Compilação de Assets (Node.js com Vite)
FROM node:18-bookworm AS node-builder
WORKDIR /app

# Copiar ficheiros de configuração necessários
COPY package*.json ./
COPY vite.config.js ./
COPY resources ./resources
COPY public ./public
COPY .env.example .env

# Instalar dependências Node com rebuild de módulos nativos
RUN npm install --legacy-peer-deps --no-optional --prefer-offline && npm rebuild

COPY . .

# Compilar assets com Vite
RUN npm run build

# Limpar cache npm para poupar espaço
RUN npm cache clean --force
RUN rm -rf node_modules

# Stage 2: Runtime PHP (Produção)
FROM php:8.2-fpm-bookworm

# Atualizar repositórios Debian
RUN apt-get update && apt-get upgrade -y

# Instalar dependências do sistema
RUN apt-get install -y \
    zip unzip git curl netcat-openbsd \
    libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Diretório da aplicação
WORKDIR /var/www

# Copiar entrypoint com permissões
COPY --chmod=755 docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh

EXPOSE 80
ENTRYPOINT ["entrypoint.sh"]
CMD ["sh", "-c", "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=80"]