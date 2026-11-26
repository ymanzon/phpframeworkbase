# Plantilla inmobiliaria — README

Plantilla genérica y configurable en Laravel para inmobiliarias: venta y
renta de casas, departamentos y terrenos, con login y catálogo.

> **Demo de ejemplo: «Hábitat Mérida», Mérida, Yucatán — identidad
> ficticia.** Todos los datos de ejemplo (nombre, teléfono
> +52 999 123 4567, WhatsApp 529991234567, correo
> contacto@habitatmerida.mx) son de prueba. Sustitúyelos por los del
> cliente real antes de publicar. No uses datos del cliente anterior en
> esta plantilla.

## Qué cambia por cliente

Solo estos archivos, sin tocar las vistas Blade ni el catálogo:

- `config/inmobiliaria.php` — nombre, eslogan, logo, colores, teléfono,
  WhatsApp, correo, ciudad, zonas, servicios, secciones y SEO.
- `.env` — las variables `INMOBILIARIA_*` (ver abajo).
- `storage/app/public/logos/logo.png` — logo del cliente.
- `storage/app/public/hero.jpg` (opcional) — imagen del hero.
- Base de datos — las propiedades del cliente, vía panel, no por código.

Regla de oro (Fase 1): si para cambiar el nombre, el teléfono, un color
o una sección tienes que editar una vista Blade, todavía no es plantilla.

### Claves que sí existen

- Color primario: `config('inmobiliaria.colores.primario')` — colores
  planos, sin `tema`. **No** uses
  `config('inmobiliaria.tema.colores.primario')`: esa clave no existe y
  el color llegaría vacío.
- Nombre: `config('inmobiliaria.nombre')`
- Teléfono visible: `config('inmobiliaria.telefono')`
- WhatsApp (solo dígitos): `config('inmobiliaria.whatsapp')`, enlace
  `https://wa.me/{{ config('inmobiliaria.whatsapp') }}`
- Secciones: `config('inmobiliaria.secciones.*')` para encender/apagar
  y `config('inmobiliaria.orden_secciones')` para reordenar. El inicio
  debe recorrer esa lista, no tener las secciones pegadas en orden fijo.

## Requisitos

- PHP **8.2** o superior (verificado en `composer.json`: `"php": "^8.2"`).
- Laravel **12** (verificado en `composer.json`: `"laravel/framework": "^12.0"`).
- Composer y MySQL/MariaDB (el `docker-compose.yaml` del repo levanta MariaDB 10.6).
- Node.js solo si vas a compilar assets con Vite (el proyecto trae `vite.config.js` con Tailwind 4); la landing actual usa CSS plano en `public/css/`, así que para verla no es obligatorio.

## Instalación desde cero

En una carpeta limpia, en este orden:

```bash
# 1. Dependencias
composer install

# 2. Entorno (copia el ejemplo, nunca subas tu .env real)
cp .env.example .env
php artisan key:generate

# 3. Base de datos: pon tus credenciales en .env (DB_DATABASE,
#    DB_USERNAME, DB_PASSWORD) y crea la base vacía en MySQL.

# 4. Migraciones + datos demo
php artisan migrate:fresh --seed

# 5. Enlace de archivos públicos (logos, fotos)
php artisan storage:link

# 6. Limpia la caché de configuración y levanta el servidor
php artisan config:clear
php artisan serve
```

Verifica la sintaxis del config antes de seguir:

```bash
php -l config/inmobiliaria.php
```

## Configuración (.env)

En `.env.example` deja documentadas, con valores de prueba:

```
INMOBILIARIA_NOMBRE=Hábitat Mérida
INMOBILIARIA_CIUDAD=Mérida, Yucatán
INMOBILIARIA_TELEFONO=+52 999 123 4567
INMOBILIARIA_WHATSAPP=529991234567
INMOBILIARIA_CORREO=contacto@habitatmerida.mx
INMOBILIARIA_CORREO_LEADS=leads@habitatmerida.mx
INMOBILIARIA_FACEBOOK=/habitatmerida
INMOBILIARIA_INSTAGRAM=@habitat.merida
```

También: `APP_NAME`, `APP_URL` y `MAIL_FROM_ADDRESS`. Nada de
credenciales reales del cliente en el repositorio.

Después de **cada** cambio en `config/inmobiliaria.php`, corre
`php artisan config:clear` antes de recargar; si no, Laravel puede
seguir sirviendo el config en caché y parecer que el cambio no funcionó.

## Datos demo

- Seeder: `PropertySeeder`, que carga las 9 propiedades de
  `database/seeders/data/propiedades-demo.json` (`DEMO-001` a
  `DEMO-009`): 6 en venta ($950,000 a $5,850,000) y 3 en renta
  ($11,000 a $23,000/mes), en Temozón Norte, Cholul, García Ginerés,
  Altabrisa, Conkal, Centro Histórico, Montebello y Caucel.
- Cada propiedad trae su mensaje de WhatsApp prellenado
  (`whatsapp_mensaje`). `mapa_url` viene vacío: se llena con la liga
  real de Google Maps de cada propiedad, no se inventa.
- Las fotos son solo nombres de archivo de ejemplo (`demo-001-1.jpg`,
  etc.): sustitúyelas por imágenes reales o de stock antes de publicar.
- `m2` no es un solo campo: usa `m2_terreno` si el tipo es `terreno`
  y `m2_construccion` en los demás casos.

## Login de prueba

- Admin de prueba (seeder `DatabaseSeeder`, identidad ficticia Hábitat Mérida):
  correo **admin@habitatmerida.mx**, contraseña **admin123**.
  **Cámbialo antes de entregar la plantilla a un cliente**; nunca uses
  datos del cliente anterior.

## Prueba rápida (Fase 1, §7)

1. Cambia solo en `config/inmobiliaria.php`: nombre, teléfono,
   WhatsApp, correo, ciudad y color primario. Recarga inicio, catálogo,
   ficha, footer y login: todo debe cambiar sin tocar ningún Blade.
   Restaura los valores de Hábitat Mérida al terminar.
2. Apaga testimonios (`secciones.testimonios => false`): **pendiente en
   esta versión** — el layout incluye las secciones fijas y aún no lee
   los interruptores de `secciones` ni `orden_secciones`. No lo pruebes
   todavía; es trabajo pendiente de Fase 1, no una falla de tu instalación.
3. Cambia `orden_secciones`: igual que el punto 2, pendiente de conectar
   en el layout.
4. En celular, abre una ficha y toca su botón de WhatsApp: debe abrir
   `wa.me/529991234567` con un mensaje sobre esa propiedad (el texto
   exacto lo arma la ficha desde el nombre y el precio, no desde el
   mensaje del JSON demo).
5. Segunda copia: copia la plantilla a otra carpeta, cámbiale solo el
   config, usa **otra base de datos** (si comparten la misma, no es una
   prueba válida), corre `php artisan migrate:fresh --seed` y levántala
   en otro puerto (`php artisan serve --port=8001`). Las dos deben
   mostrar su propio nombre y color, sin mezclarse.
6. Instalación desde cero: sigue solo este README en una carpeta
   limpia. Si algún paso falta o falla, corrige este README, no lo
   memorices.

## Antes de entregar a un cliente

- [ ] Ningún dato del cliente anterior queda en código, vistas,
      correos, seeders, `.env.example` ni en este README (nombre,
      teléfono, correo, propiedades, fotos, usuarios ni leads reales).
      La base de datos de la copia se regenera solo con datos demo:
      `php artisan migrate:fresh --seed`.
- [ ] `php -l config/inmobiliaria.php` sin errores.
- [ ] `config/inmobiliaria.php` restaurado a los datos del cliente
      nuevo (o a Hábitat Mérida, si es la demo) y `config:clear` corrido.
- [ ] Logo y hero del cliente subidos a `storage/`, no rutas fijas a
      fotos del cliente anterior.
- [x] Versiones exactas de PHP/Laravel y credenciales del admin de
      prueba rellenadas arriba (PHP 8.2, Laravel 12, admin@habitatmerida.mx).
