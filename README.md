1. Recursos para desarrollo
Git: https://git-scm.com/install/windows

Laragon: https://github.com/leokhoa/laragon/releases/download/6.0.0/laragon-wamp.exe

Postman: https://www.postman.com/downloads/

Hoppscotch: https://hoppscotch.io/ (alternativa web)

2. Instalación de Git
Ejecutar instalador → Siguiente hasta finalizar (configuración por defecto)

3. Instalación de Laragon
Ejecutar instalador → Siguiente hasta finalizar

Abrir Laragon → Menú → PATH variable de entornos → Add to Laragon Path

4. Instalación de Postman
Ejecutar instalador → Siguiente hasta finalizar

Al abrir: Continue Without an account → Open lightweight API Client

5. Configuración del Proyecto Laravel
bash
# Crear proyecto
composer create-project laravel/laravel mi-proyecto
cd mi-proyecto

# Crear modelo, controlador, migración y requests
php artisan make:model Venta -m -c --api --requests

# Configurar base de datos en .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ventas_db
DB_USERNAME=root
DB_PASSWORD=

# Ejecutar migración
php artisan migrate
6. Corrección de errores (Modelo Venta)
Problema: Error "Undefined array key 'impuesto'" al crear ventas

Solución implementada: Observer para cálculos automáticos

bash
php artisan make:observer VentaObserver --model=Venta
Códigos modificados:

app/Models/Venta.php - Configuración de fillable y casts

app/Observers/VentaObserver.php - Lógica de cálculo (subtotal y total)

app/Providers/EventServiceProvider.php - Registro del observer

app/Http/Controllers/Api/VentaController.php - Métodos CRUD

routes/api.php - Rutas RESTful

7. Endpoints API Disponibles
   Método Endpoint Descripción
   GET /api/ventas Listar ventas
   POST /api/ventas Crear venta
   GET /api/ventas/{id} Ver venta
   PUT/PATCH /api/ventas/{id} Actualizar venta
   DELETE /api/ventas/{id} Eliminar venta
   POST /api/ventas/{id}/restore Restaurar venta
   GET /api/ventas/estadisticas Estadísticas

8. Probar con Postman json

POST http://localhost:8000/api/ventas
   {
      "cliente_nombre": "Juan Pérez",
      "producto": "Laptop",
      "cantidad": 2,
      "precio_unitario": 750.00,
      "impuesto": 60.00,
      "metodo_pago": "tarjeta",
      "fecha_venta": "2026-06-14"
   }

9. Commands útiles
bash
# Generar datos de prueba
php artisan make:factory VentaFactory --model=Venta
php artisan make:seeder VentaSeeder
php artisan db:seed --class=VentaSeeder

# Limpiar caché
php artisan optimize:clear

# Servidor local
php artisan serve
