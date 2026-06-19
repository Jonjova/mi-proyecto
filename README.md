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

# ============================================
# CREAR NUEVO PROYECTO LARAVEL
# ============================================
# Abrir terminal (CMD o PowerShell) y ejecutar:

# Crear proyecto Laravel 11
composer create-project laravel/laravel api-ventas

# Navegar al directorio del proyecto
cd api-ventas

# ============================================
# CREAR MODELO, CONTROLADOR, MIGRACIÓN Y REQUESTS
# ============================================
# Crear todo de una vez con los flags necesarios
# -m: crea migración
# -c: crea controlador
# --api: crea controlador con métodos API (index, store, show, update, destroy)
# --requests: crea archivos de validación (Form Requests)
php artisan make:model Venta -m -c --api --requests

# Esto generará:
# - app/Models/Venta.php
# - database/migrations/xxxx_xx_xx_create_ventas_table.php
# - app/Http/Controllers/VentaController.php
# - app/Http/Requests/StoreVentaRequest.php
# - app/Http/Requests/UpdateVentaRequest.php

# ============================================
# CONFIGURAR ENTORNO (.env)
# ============================================
# Crear archivo .env a partir de .env.example
copy .env.example .env
# En Linux/Mac: cp .env.example .env

# Generar clave de aplicación
php artisan key:generate

# ============================================
# CONFIGURAR BASE DE DATOS
# ============================================
# Abrir el archivo .env y configurar:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=ventas_db
# DB_USERNAME=root
# DB_PASSWORD=

# Crear la base de datos en MySQL (usando Laragon)
# Abrir Laragon → Menú → MySQL → phpMyAdmin
# Crear una nueva base de datos llamada "ventas_db"

# O desde terminal MySQL:
mysql -u root -p
# (presionar Enter sin contraseña)
CREATE DATABASE ventas_db;
EXIT;

# ============================================
# INSTALAR DEPENDENCIAS Y EJECUTAR
# ============================================
# Instalar dependencias PHP
composer install

# Ejecutar migraciones para crear la tabla
php artisan migrate

# Iniciar servidor de desarrollo
php artisan serve

# El proyecto estará disponible en: http://127.0.0.1:8000