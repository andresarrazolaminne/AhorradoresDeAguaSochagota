# Despliegue: **https://tod.com.co/cdgf/**

La app vive en **`/usr/share/nginx/html/cdgf`** y se expone como **subcarpeta** del dominio principal (**no** subdominio).

## Variables `.env` (obligatorio para subcarpeta)

```env
APP_URL=https://tod.com.co/cdgf
APP_PATH_PREFIX=cdgf
APP_ENV=production
APP_DEBUG=false
```

- **`APP_URL`**: URL pública exacta del proyecto (sin barra final, o con ella según tu convención; Laravel suele usar sin barra final).
- **`APP_PATH_PREFIX`**: solo el segmento de ruta (`cdgf`). Debe coincidir con la carpeta en la URL.

## Front (Vite) — importante

`vite.config.js` usa **`APP_PATH_PREFIX`** para el `base` de los assets. En el servidor, **antes de `npm run build`**, el `.env` debe tener ya `APP_PATH_PREFIX=cdgf`. Si compilas sin eso, los CSS/JS pedirían `/build/...` en lugar de `/cdgf/build/...`.

```bash
cd /usr/share/nginx/html/cdgf
# .env con APP_PATH_PREFIX=cdgf y APP_URL=https://tod.com.co/cdgf
npm ci
npm run build
```

## Nginx

1. El sitio **`tod.com.co`** ya tiene su `server { ... }`.
2. Dentro de ese mismo `server` (HTTP y/o HTTPS), **incluye** el snippet:

   ```bash
   sudo cp deploy/nginx-cdgf.tod.com.co.conf /etc/nginx/snippets/cdgf-laravel.conf
   ```

   Y en el `server` de tod.com.co:

   ```nginx
   include /etc/nginx/snippets/cdgf-laravel.conf;
   ```

3. Ajusta el **upstream `cdgf-php`** (socket o puerto de PHP-FPM de tu máquina).
4. Prueba y recarga:

   ```bash
   sudo nginx -t && sudo systemctl reload nginx
   ```

Si el mismo `server` ya tiene un `location ~ \.php$` genérico, incluye **`cdgf-laravel.conf` antes** de ese bloque (o reordena), para que las peticiones a `/cdgf/index.php` no las atrape el bloque equivocado.

El archivo define:

- Redirección `/cdgf` → `/cdgf/`
- `alias` a `…/cdgf/public/`
- Reescritura a **`index.php`** con el resto del path (compatible con Laravel en subcarpeta)

**Certificado SSL**: si `tod.com.co` ya tiene HTTPS, **cdgf** usa el mismo `server` y el mismo certificado; no hace falta un host extra.

## Resto igual que antes

- `composer install --no-dev --optimize-autoloader`
- `php artisan key:generate` (si es instalación nueva)
- `php artisan migrate --force`
- `php artisan storage:link` si aplica
- `php artisan config:cache && php artisan route:cache && php artisan view:cache`
- Permisos de escritura en `storage/` y `bootstrap/cache/` para el usuario de PHP-FPM

## Comprobaciones

- `https://tod.com.co/cdgf/` — inicio  
- `https://tod.com.co/cdgf/registro` — formulario  
- Registro de prueba → `/cdgf/registro/expectativa`

## Desarrollo local

En `.env` local deja **`APP_PATH_PREFIX` vacío** y `APP_URL=http://127.0.0.1:8000`; ejecuta `npm run build` o `npm run dev` sin prefijo.
