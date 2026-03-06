#!/bin/sh

echo "🚀 Iniciando aplicação Laravel no Render..."

# Ajusta dono e permissões
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Limpando caches do Laravel
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Recriando caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Rodando migrations sem apagar dados
php artisan migrate --force

# Build do Vite (apenas se não houver build existente)
if [ ! -d "/var/www/public/build" ]; then
  echo "📦 Buildando Vite..."
  npm install
  npm run build
fi

# Iniciando PHP-FPM
echo "⚡ Iniciando PHP-FPM..."
php-fpm -D

# Iniciando Nginx em foreground
echo "🌍 Iniciando Nginx..."
nginx -g "daemon off;"