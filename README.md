# API de Registro de Ventas - Laravel

API RESTful para gestión de ventas con Laravel 11, incluye CRUD completo, validaciones, soft deletes y estadísticas.

## 📋 Requisitos Previos

- PHP >= 8.1
- Composer
- MySQL
- Git (opcional)

## 🛠️ Herramientas de Desarrollo

| Herramienta | Enlace | Descripción |
|-------------|--------|-------------|
| Git | [https://git-scm.com/install/windows](https://git-scm.com/install/windows) | Control de versiones |
| Laragon | [https://github.com/leokhoa/laragon/releases/download/6.0.0/laragon-wamp.exe](https://github.com/leokhoa/laragon/releases/download/6.0.0/laragon-wamp.exe) | Entorno de desarrollo |
| Postman | [https://www.postman.com/downloads/](https://www.postman.com/downloads/) | Cliente API (escritorio) |
| Hoppscotch | [https://hoppscotch.io/](https://hoppscotch.io/) | Cliente API (web) |

## 🚀 Instalación

### 1. Instalar Git
- Ejecutar el instalador → Siguiente → Siguiente → Finalizar

### 2. Instalar Laragon
- Ejecutar el instalador → Siguiente hasta finalizar
- Abrir Laragon → Menú → `PATH variable de entornos` → `Add to Laragon Path`

### 3. Instalar Postman
- Ejecutar el instalador → Siguiente hasta finalizar
- Al abrir: `Continue Without an account` → `Open lightweight API Client`

### 4. Configurar Proyecto Laravel

```bash
# Crear nuevo proyecto
composer create-project laravel/laravel mi-proyecto
cd mi-proyecto

# Crear modelo, controlador, migración y requests
php artisan make:model Venta -m -c --api --requests

# Configurar base de datos en .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=ventas_db
# DB_USERNAME=root
# DB_PASSWORD=

# Ejecutar migración
php artisan migrate