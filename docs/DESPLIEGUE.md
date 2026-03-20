# Despliegue en servidor (Laravel 11 + Vite + MySQL)

Guía para llevar **Sochagota / Cazadores de Gastos Fantasma** a producción en un VPS o hosting con PHP y acceso SSH.

## Requisitos del servidor

- **PHP 8.2+** con extensiones: `ctype`, `curl`, `dom`, `fileinfo`, `mbstring`, `openssl`, `pdo`, `pdo_mysql`, `tokenizer`, `xml`, `json`
- **Composer 2** (en el servidor o en tu máquina para generar `vendor` antes de subir)
- **MySQL** accesible desde el servidor (mismo que ya usas para `registro_interes`)
- **Node.js 20+** *solo si vas a compilar assets en el servidor*; si no, compila en local/CI y sube `public/build/`

## Regla importante: document root

El **Document Root** del sitio (Apache/Nginx) debe ser la carpeta **`public/`** del proyecto, no la raíz del repositorio.

```
/var/www/sochagota/public   ← aquí debe apuntar el virtual host
```

## 1. Subir el código

Opciones habituales:

- `git clone` en el servidor y `git pull` en cada release, o  
- Subir por SFTP/rsync **excluyendo** lo que no hace falta en servidor: `.git`, `node_modules`, `.env`, tests opcionales.

Archivos que **sí** deben existir en producción:

- Todo el código fuente de la app  
- **`vendor/`** (resultado de `composer install --no-dev`)  
- **`public/build/`** (resultado de `npm ci && npm run build`)  
- Logos en **`public/logos/`** (sochagota, seguros bolívar, campaña `campana-cazadores-*.png`)

## 2. Variables de entorno (`.env`)

En el servidor, copia `.env.example` a `.env` y configura al menos:

```env
APP_NAME=Sochagota
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tu-dominio.com

LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=TU_HOST_MYSQL
DB_PORT=3306
DB_DATABASE=TU_BASE_DE_DATOS
DB_USERNAME=TU_USUARIO
DB_PASSWORD="tu_contraseña"

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

Genera la clave si es un `.env` nuevo:

```bash
php artisan key:generate
```

**`APP_URL`** debe ser la URL real con `https://` (evita cookies/session rotas y URLs mal generadas).

## 3. Instalar dependencias PHP

```bash
composer install --no-dev --optimize-autoloader
```

## 4. Front (Vite / Tailwind)

**Opción A — En el servidor** (si tienes Node):

```bash
npm ci
npm run build
```

**Opción B — En tu PC o CI**: ejecutar `npm ci && npm run build` y subir la carpeta **`public/build/`** completa.

## 5. Base de datos

```bash
php artisan migrate --force
```

La tabla `registro_interes` queda creada por la migración del proyecto.

## 6. Enlace de almacenamiento y permisos

```bash
php artisan storage:link
```

Permisos típicos en Linux (ajusta usuario/grupo a tu web server, p. ej. `www-data`):

```bash
chmod -R ug+rwx storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## 7. Cachés de Laravel (producción)

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Tras cambiar `.env` o rutas/views en un despliegue nuevo:

```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
# volver a aplicar los tres cache de arriba
```

## 8. Nginx (referencia)

Hay un ejemplo genérico en **`deploy/nginx-site.example.conf`**.

Para **`https://tod.com.co/cdgf/`** (subcarpeta, sin subdominio), usa el snippet **`deploy/nginx-cdgf.tod.com.co.conf`** dentro del `server` de **tod.com.co** y la guía **`deploy/CDGF-SERVIDOR.md`** (`APP_URL` + `APP_PATH_PREFIX=cdgf`, y `npm run build` con ese `.env`).

Para HTTPS, usa **Certbot** u otro emisor; fuerza `APP_URL` con `https`.

## 9. Comprobaciones rápidas

- Abrir `/` → home con animaciones y logos.  
- Abrir `/registro` → formulario.  
- Enviar un registro de prueba → redirección a `/registro/expectativa` y fila en MySQL.

## 10. Mantenimiento

```bash
php artisan down    # activar modo mantenimiento
php artisan up      # desactivar
```

---

Si tu proveedor es **solo cPanel sin SSH**, suele haber “Setup Laravel” o hay que subir `vendor` y `public/build` ya generados, configurar `.env` en el administrador y apuntar el dominio a `public`. En ese caso pide a soporte que el **document root** sea `public`.
