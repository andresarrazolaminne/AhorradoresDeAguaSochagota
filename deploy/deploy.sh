#!/usr/bin/env bash
# Ejecutar en el servidor, dentro de la raíz del proyecto (donde está artisan).
set -e

echo "== Composer (producción) =="
composer install --no-dev --optimize-autoloader

echo "== Assets (omitir si ya subes public/build) =="
if command -v npm >/dev/null 2>&1; then
  npm ci
  npm run build
else
  echo "npm no encontrado; asegúrate de tener public/build actualizado."
fi

echo "== Laravel =="
php artisan storage:link || true
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Listo. Revisa APP_ENV=production, APP_DEBUG=false y APP_URL en .env"
