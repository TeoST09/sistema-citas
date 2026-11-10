# PawlinaPet

Sistema web para la gestión de una clínica veterinaria. PawlinaPet reúne en un solo lugar la administración de mascotas, servicios, reservas y cuentas de usuario, con roles para clientes, veterinarios y administradores.

<p align="center">
  <img alt="Laravel 13" src="https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white">
  <img alt="PHP 8.3+" src="https://img.shields.io/badge/PHP-8.3%2B-777BB4?logo=php&logoColor=white">
  <img alt="MySQL" src="https://img.shields.io/badge/MySQL-database-4479A1?logo=mysql&logoColor=white">
  <img alt="JavaScript" src="https://img.shields.io/badge/JavaScript-ES_modules-F7DF1E?logo=javascript&logoColor=black">
  <img alt="Bootstrap" src="https://img.shields.io/badge/Bootstrap-5-7952B3?logo=bootstrap&logoColor=white">
  <img alt="Tabler" src="https://img.shields.io/badge/UI-Tabler-206BC4">
</p>

> **Interfaz:** las páginas se renderizan con Laravel Blade, HTML y CSS.

## Funcionalidades

- Registro e inicio de sesión.
- Gestión de mascotas, especies y razas.
- Consulta de servicios veterinarios.
- Creación y administración de reservas.
- Paneles para administrar servicios y usuarios.
- Roles de usuario, veterinario y administrador.
- Configuración de cuenta y actualización de contraseña.

## Tecnologías

- **Backend:** PHP 8.3+ y Laravel 13.
- **Vistas:** Blade, HTML y CSS.
- **Frontend:** JavaScript con módulos ES.
- **Estilos y componentes:** Bootstrap y Tabler.
- **Base de datos:** MySQL

## Requisitos

- PHP 8.3 o superior y Composer.
- Node.js y npm.
- MySQL instalado y ejecutándose.

## Instalación

1. Clona el repositorio y entra en el proyecto:

   ```bash
   git clone <https://github.com/TeoST09/sistema-citas>
   cd sistema-citas
   ```

2. Instala las dependencias:

   ```bash
   composer install
   npm install
   ```

3. Configura el entorno:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   En Windows PowerShell, usa `Copy-Item .env.example .env` en lugar de `cp`.

4. Crea una base de datos MySQL y actualiza las variables de conexión en `.env`:

   ```dotenv
   APP_NAME=PawlinaPet
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pet
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Ejecuta las migraciones y carga los datos iniciales:

   ```bash
   php artisan migrate --seed
   ```

6. Inicia el servidor de desarrollo y Vite en terminales separadas:

   ```bash
   php artisan serve
   ```

   ```bash
   npm run dev
   ```

   Abre la URL que muestra Artisan, normalmente `http://127.0.0.1:8000`.

Para generar los recursos de frontend para producción:

```bash
npm run build
```

## Pruebas

```bash
php artisan test
```

## Estructura principal

```text
app/
  Http/Controllers/   Controladores de autenticación y módulos
  Models/             Modelos de la aplicación
database/
  migrations/         Estructura de la base de datos
  seeders/            Roles y datos iniciales
resources/
  views/              Vistas Blade
  css/                Estilos
  js/                 JavaScript de la aplicación
routes/
  web.php             Rutas web
```
