# Despliegue en servidor: **cdgf.tod.com.co** → `/usr/share/nginx/html/cdgf`

Ruta del código Laravel: **`/usr/share/nginx/html/cdgf`**  
Subdominio: **`cdgf.tod.com.co`** (DNS tipo **A** o **CNAME** hacia el servidor).  
Nginx debe servir **`/usr/share/nginx/html/cdgf/public`**, no la carpeta padre `cdgf`.

## 1. Código en el servidor

```bash
cd /usr/share/nginx/html
sudo git clone https://github.com/andresarrazolaminne/AhorradoresDeAguaSochagota.git cdgf
cd cdgf
```

Si la carpeta ya existe, usa `git pull` dentro de `cdgf`.

## 2. Dependencias y assets

```bash
cd /usr/share/nginx/html/cdgf
composer install --no-dev --optimize-autoloader
npm ci
npm run build
```

Si no hay Node en el servidor, ejecuta `npm ci && npm run build` en tu PC y sube la carpeta **`public/build/`**.

## 3. Entorno Laravel

```bash
cp .env.example .env
nano .env   # o vim
```

Mínimo en producción:

```env
APP_NAME=Sochagota
APP_ENV=production
APP_DEBUG=false
APP_URL=https://cdgf.tod.com.co

DB_CONNECTION=mysql
DB_HOST=...
DB_PORT=3306
DB_DATABASE=...
DB_USERNAME=...
DB_PASSWORD="..."

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

```bash
php artisan key:generate
php artisan migrate --force
php artisan storage:link || true
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 4. Permisos

Propietario al usuario con el que corre **PHP-FPM** (`nginx` en RHEL/Alma o `www-data` en Debian/Ubuntu):

```bash
# Ejemplo Alma/Rocky/CentOS (usuario nginx):
sudo chown -R nginx:nginx /usr/share/nginx/html/cdgf/storage /usr/share/nginx/html/cdgf/bootstrap/cache

# Ejemplo Debian/Ubuntu:
# sudo chown -R www-data:www-data /usr/share/nginx/html/cdgf/storage /usr/share/nginx/html/cdgf/bootstrap/cache

sudo chmod -R ug+rwx /usr/share/nginx/html/cdgf/storage /usr/share/nginx/html/cdgf/bootstrap/cache
```

## 5. Nginx

1. Copia `deploy/nginx-cdgf.tod.com.co.conf` al servidor.
2. Ajusta el **`upstream php-fpm-cdgf`**: deja **una sola** línea `server unix:...` que exista en tu máquina, por ejemplo:

   ```bash
   ls /var/run/php/
   # o
   ls /run/php-fpm/
   ```

3. Instala el archivo, por ejemplo:

   ```bash
   sudo cp nginx-cdgf.tod.com.co.conf /etc/nginx/conf.d/cdgf.tod.com.co.conf
   sudo nginx -t && sudo systemctl reload nginx
   ```

4. HTTPS:

   ```bash
   sudo certbot --nginx -d cdgf.tod.com.co
   ```

   Después confirma que `APP_URL=https://cdgf.tod.com.co` y ejecuta `php artisan config:cache`.

## 6. DNS

En el panel de **tod.com.co**, crea un registro para **`cdgf`**:

- **A** → IP pública del servidor, o  
- **CNAME** → hostname del servidor, según tu proveedor.

## 7. Comprobación

- `https://cdgf.tod.com.co/` → inicio  
- `https://cdgf.tod.com.co/registro` → formulario  
- Registro de prueba → `/registro/expectativa`

## SELinux (solo si está activo en RHEL/CentOS/Alma)

Si ves errores 403 o PHP no escribe en `storage`:

```bash
sudo chcon -R -t httpd_sys_rw_content_t /usr/share/nginx/html/cdgf/storage
sudo chcon -R -t httpd_sys_rw_content_t /usr/share/nginx/html/cdgf/bootstrap/cache
```

(Ajusta según políticas de tu host; en muchos servidores ya viene resuelto.)
