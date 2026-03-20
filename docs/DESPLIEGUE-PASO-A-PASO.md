# Despliegue paso a paso (servidor con varias apps ya en marcha)

Esta guía asume **Linux** en el servidor, acceso por **SSH** (usuario con permisos `sudo` cuando haga falta), y que **tod.com.co** ya está sirviendo otras aplicaciones con **Nginx**.

La app CDGF quedará en **`https://tod.com.co/cdgf/`**. No es un sitio nuevo en otro puerto: **usa los mismos puertos 80 y 443** que el resto del dominio.

---

## 0. Conceptos rápidos (para no liarte con “puertos”)

| Qué | ¿Necesitas un puerto nuevo para CDGF? |
|-----|----------------------------------------|
| **Nginx** | No. Suele escuchar **80** (HTTP) y **443** (HTTPS) para **todos** los sitios. Cada “sitio” se distingue por `server_name` o por la ruta (`/cdgf/`). |
| **PHP-FPM** (ejecuta Laravel) | Casi nunca. Suele hablar con Nginx por un **socket Unix** (un archivo, no un puerto). Todas las apps PHP del servidor pueden compartir el **mismo** PHP-FPM. |
| **MySQL** | Ya está en un puerto (típico **3306**). Laravel solo se **conecta** como cliente; no abres puertos nuevos en el servidor por CDGF. |

**Conclusión:** en un despliegue típico **no tienes que reservar un puerto libre** solo para CDGF. Si más adelante alguien te pide “qué puertos usa”, lo normal es: **80, 443** (Nginx) y **3306** (MySQL, a veces solo interno).

Si quieres **ver qué está escuchando** en el servidor (cultura general):

```bash
sudo ss -tlnp
```

- **`t`** = TCP, **`l`** = en escucha, **`n`** = numérico, **`p`** = proceso.  
- Verás líneas con `:80`, `:443`, `:3306`, etc.

Otra orden útil:

```bash
sudo systemctl status nginx
sudo systemctl status php-fpm
```

(En Ubuntu el servicio puede llamarse `php8.2-fpm`; en AlmaLinux a veces `php-fpm`.)

---

## 1. Entrar al servidor

Desde tu PC (PowerShell, Terminal, etc.), algo como:

```bash
ssh tu_usuario@LA_IP_DEL_SERVIDOR
```

Sustituye `tu_usuario` y la IP o hostname por los que te dio tu proveedor.

---

## 2. Elegir carpeta y bajar el código

Convención acordada:

- Código Laravel: **`/usr/share/nginx/html/cdgf`**

Comandos (ruta padre primero):

```bash
cd /usr/share/nginx/html
sudo mkdir -p cdgf
sudo chown "$USER:$USER" cdgf
cd cdgf
```

Clonar el repositorio **dentro** de `cdgf` (el contenido del repo debe quedar en esta carpeta; si clonas mal, verás una subcarpeta extra con el nombre del repo):

```bash
git clone https://github.com/andresarrazolaminne/AhorradoresDeAguaSochagota.git .
```

El **punto final** `.` es importante: significa “clonar aquí dentro, no crear otra subcarpeta”.

Si la carpeta ya tiene archivos viejos, usa `git pull` dentro de `cdgf` en actualizaciones futuras.

---

## 3. PHP y Composer

Comprueba versión de PHP (Laravel 11 pide **8.2+**):

```bash
php -v
```

Si no tienes Composer global:

```bash
composer --version
```

Si falta Composer, en muchos servidores se instala con la documentación oficial de Composer o con el gestor del SO (`dnf install composer`, `apt install composer`, etc., según distro).

Instala dependencias **de producción** del proyecto:

```bash
cd /usr/share/nginx/html/cdgf
composer install --no-dev --optimize-autoloader
```

---

## 4. Node.js y el front (Vite)

Comprueba Node:

```bash
node -v
npm -v
```

En la carpeta del proyecto:

```bash
cd /usr/share/nginx/html/cdgf
```

**Antes** debes tener el `.env` listo con `APP_PATH_PREFIX` (paso 5). Cuando `.env` esté bien:

```bash
npm ci
npm run build
```

Esto genera **`public/build/`** (CSS/JS). Si compilas **sin** `APP_PATH_PREFIX=cdgf`, la web cargará pero **sin estilos** (rutas `/build/...` incorrectas).

---

## 5. Archivo `.env` (crítico)

```bash
cd /usr/share/nginx/html/cdgf
cp .env.example .env
nano .env
```

(use `nano` o el editor que prefieras)

Valores mínimos recomendados para **producción en subcarpeta**:

```env
APP_NAME=Sochagota
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tod.com.co/cdgf
APP_PATH_PREFIX=cdgf

DB_CONNECTION=mysql
DB_HOST=…
DB_PORT=3306
DB_DATABASE=…
DB_USERNAME=…
DB_PASSWORD="…"

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

Generar clave de aplicación (solo si es instalación nueva):

```bash
php artisan key:generate
```

Base de datos:

```bash
php artisan migrate --force
```

Opciones de caché de Laravel:

```bash
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 6. Permisos (PHP debe poder escribir)

El usuario que ejecuta **PHP-FPM** (no siempre es tu usuario SSH) debe poder escribir en `storage` y `bootstrap/cache`.

Averigua el usuario de PHP-FPM:

```bash
grep -E '^user|^group' /etc/php-fpm.d/www.conf 2>/dev/null
# o
grep -E '^user|^group' /etc/php/*/fpm/pool.d/www.conf 2>/dev/null
```

Valores típicos: **`nginx`**, **`www-data`**, **`apache`**.

Ejemplo si el usuario es `nginx`:

```bash
cd /usr/share/nginx/html/cdgf
sudo chown -R nginx:nginx storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
```

---

## 7. Nginx: encajar CDGF sin romper otras apps

Aquí **no** creas un servidor nuevo en otro puerto. Solo añades reglas para la **ruta `/cdgf/`** dentro del **`server` que ya atiende `tod.com.co`**.

### 7.1 Encuentra el archivo de tod.com.co

Prueba:

```bash
grep -r "server_name" /etc/nginx/ 2>/dev/null | grep -i tod
```

Busca un fichero que contenga algo como `server_name tod.com.co` (o `www.tod.com.co`).

También:

```bash
ls /etc/nginx/conf.d/
ls /etc/nginx/sites-enabled/
```

### 7.2 Copia el snippet del proyecto

Desde la raíz del repo en el servidor:

```bash
sudo cp /usr/share/nginx/html/cdgf/deploy/nginx-cdgf.tod.com.co.conf /etc/nginx/snippets/cdgf-laravel.conf
```

### 7.3 Ajusta PHP-FPM en el snippet

Abre el snippet:

```bash
sudo nano /etc/nginx/snippets/cdgf-laravel.conf
```

En el bloque **`upstream cdgf-php`** deja **solo una** línea `server` activa. Para saber cuál existe, lista sockets:

```bash
ls -la /var/run/php/
ls -la /run/php-fpm/ 2>/dev/null
```

Ejemplos frecuentes:

- `unix:/var/run/php/php8.2-fpm.sock`
- `unix:/var/run/php/php-fpm.sock`
- `unix:/run/php-fpm/www.sock`

Si tu servidor usa PHP por **TCP** (menos habitual):

- `127.0.0.1:9000`

**Conflicto de nombres:** si ya tienes otro `upstream cdgf-php` en algún archivo, renombra este a algo único (por ejemplo `cdgf-php-tod`) y cambia ambas apariciones de `fastcgi_pass cdgf-php` a ese nombre.

### 7.4 Incluye el snippet en el `server` correcto

Edita el archivo donde está **`server_name tod.com.co`** (el de HTTPS si ya usas SSL).

**Dentro** del bloque `server { ... }`, en un lugar razonable, añade:

```nginx
include /etc/nginx/snippets/cdgf-laravel.conf;
```

**Importante:** si en ese mismo `server` existe un `location ~ \.php$` muy genérico que matchea **antes** que las reglas de CDGF, puede robarte las peticiones a `/cdgf/index.php`. Si tras recargar Nginx la ruta falla, prueba poniendo el **`include ...cdgf-laravel.conf`** **encima** (más arriba en el fichero) de ese `location ~ \.php$`.

Prueba sintaxis y recarga:

```bash
sudo nginx -t
sudo systemctl reload nginx
```

Si `nginx -t` da error, **no** hagas `reload` hasta corregirlo (te indicará archivo y línea).

---

## 8. DNS

En el panel DNS de **tod.com.co**, no hace falta un registro nuevo para CDGF si **el mismo dominio** ya apunta al servidor. `/cdgf/` es solo una ruta. Si `https://tod.com.co` ya funciona, la ruta `/cdgf/` la resuelve el mismo Nginx.

---

## 9. Probar en el navegador

Abre:

1. `https://tod.com.co/cdgf/`
2. `https://tod.com.co/cdgf/registro`

Haz un registro de prueba y comprueba que llegue a la pantalla de expectativa y a la base de datos.

---

## 10. Actualizar la app más adelante

```bash
cd /usr/share/nginx/html/cdgf
git pull
composer install --no-dev --optimize-autoloader
npm ci
npm run build
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

(No hace falta tocar Nginx cada vez si no cambias rutas del servidor.)

---

## 11. Problemas frecuentes

| Síntoma | Causa posible |
|--------|----------------|
| Página en blanco o 500 | `.env` mal, permisos en `storage`, ver `storage/logs/laravel.log` |
| Sin CSS / diseño roto | `npm run build` sin `APP_PATH_PREFIX=cdgf` en `.env` antes de compilar |
| 404 en `/cdgf/` | Snippet no incluido, o `alias` apunta a ruta incorrecta |
| Descarga en vez de ejecutar PHP | PHP-FPM mal enlazado; `fastcgi_pass` o socket incorrecto |
| 419 en formularios | `APP_URL` no coincide con la URL real; limpia caché `php artisan config:clear` y vuelve a `config:cache` |

---

## 12. Resumen checklist

1. Clonar repo en `/usr/share/nginx/html/cdgf`  
2. `composer install --no-dev`  
3. Crear `.env` con `APP_URL` y `APP_PATH_PREFIX=cdgf` + MySQL  
4. `php artisan key:generate` → `migrate --force` → caches  
5. `npm ci` y `npm run build`  
6. Permisos `storage` y `bootstrap/cache`  
7. Copiar snippet a `/etc/nginx/snippets/` y ajustar socket PHP  
8. `include` dentro del `server` de **tod.com.co**  
9. `sudo nginx -t` y `reload`  
10. Probar `https://tod.com.co/cdgf/`

Si me pegas la salida de `sudo nginx -t` o un error concreto del navegador (código y mensaje), se puede afinar el siguiente paso.
