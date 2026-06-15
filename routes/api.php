<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VentaController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas (requieren token válido)
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('ventas')->group(function () {
        Route::get('/', [VentaController::class, 'index']);           // GET    /api/ventas
        Route::post('/', [VentaController::class, 'store']);         // POST   /api/ventas
        Route::get('/estadisticas', [VentaController::class, 'estadisticas']); // GET /api/ventas/estadisticas
        Route::get('/{venta}', [VentaController::class, 'show']);     // GET    /api/ventas/{id}
        Route::put('/{venta}', [VentaController::class, 'update']);   // PUT    /api/ventas/{id}
        Route::patch('/{venta}', [VentaController::class, 'update']); // PATCH  /api/ventas/{id}
        Route::delete('/{venta}', [VentaController::class, 'destroy']); // DELETE /api/ventas/{id}
        Route::post('/{id}/restore', [VentaController::class, 'restore']); // POST /api/ventas/{id}/restore
    });
});
