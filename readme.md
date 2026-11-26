Modo de instalacion e uso
# lanzamiento de los ambientes
```bash
# Iniciar los contenedores
docker-compose up -d
```
# acceder al contenedor principal de laravel
```bash
# Acceder al contenedor PHP
docker exec -it laravel-app bash
```

# dentro del contenedor, crear el projyecto inicial
```bash
# Dentro del contenedor, crear un nuevo proyecto Laravel
composer create-project --prefer-dist laravel/laravel .
```

# otorgar permisos a laravel
## Para el contenedor de Apache
```bash
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
```

## Para el contenedor PHP-FPM si estás usando Nginx
```bash
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
```

# redireccionar el uso de sqlite a mysql
## cambiar archivo config/database.php 
```php
    'default' => env('DB_CONNECTION', 'mysql'),
```

# permisos para el storage
## Paso a paso para crear el storage link manualmente 
### acceder al public_html
```shell
    cd ~/public_html

```

### Crea el symlink apuntando al storage de Laravel:
```shell
    ls -s ../laravel_app/storage/app/public storage
    o
    ls -s ../laravel_app/storage storage
```
Esto crea: public_html/storage → ../laravel_app/storage/app/public

### Verifica que se haya creado correctamente:
```shell
    ln -l storage
```
### deberia mostrar 
```shell
    storage -> ../l/laravel_app/storage/app/public
```

## Permisos 
### hay que darles permisos a las carpetas storage y cache de bootstrap
```shell
    chmod -R 775 ~/l/laravel_app/storage
    chmod -R 775 ~/l/laravel_app/bootstrap/cache
```
valida usar el comando 777 para los permisos.

	

# actualizar la conexion del archivo .env de mariadb connection
```env
DB_CONNECTION=mysql
DB_HOST=mariadb-server
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
```

# lanzar la migraciones para laravel
```bash
php artisan session:table
php artisan migrate --force
php artisan config:clear
```

# crear el archivo de debug en visualcodestudio
## archivo launch.json
```json
{
  "version": "0.2.0",
  "configurations": [
      {
          "name": "Listen for Xdebug",
          "type": "php",
          "request": "launch",
          "port": 9003, 
          "pathMappings": {
              "/var/www/html": "${workspaceFolder}/src"
          },
          "log": true
      }
  ]
}
```


# otros comandos docker
```bash
#baja el ambiente docker
docker-compose down     

#muestra los contenedores corriendo
docker ps               

# Reconstruir las imágenes
docker-compose build --no-cache

```
---
## Plantilla inmobiliaria (este repo)
La plantilla genérica vive en `src/`. Su README es `src/README.md`: instalación desde cero, qué cambia por cliente y prueba rápida. Los datos de ejemplo son de «Hábitat Mérida» (ficticia, Mérida, Yucatán).
