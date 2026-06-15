<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Venta;
use App\Http\Requests\VentaRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VentaController extends Controller
{
    // Listar todas las ventas
    public function index(Request $request): JsonResponse
    {
        $query = Venta::query();

        // Filtros opcionales
        if ($request->has('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->has('fecha_desde')) {
            $query->whereDate('fecha_venta', '>=', $request->fecha_desde);
        }

        if ($request->has('fecha_hasta')) {
            $query->whereDate('fecha_venta', '<=', $request->fecha_hasta);
        }

        if ($request->has('cliente')) {
            $query->where('cliente_nombre', 'like', '%' . $request->cliente . '%');
        }

        $ventas = $query->orderBy('created_at', 'desc')->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $ventas,
            'message' => 'Ventas obtenidas exitosamente'
        ]);
    }

    // Crear nueva venta
    public function store(VentaRequest $request): JsonResponse
    {
        $venta = Venta::create($request->validated());

        return response()->json([
            'success' => true,
            'data' => $venta,
            'message' => 'Venta registrada exitosamente'
        ], 201);
    }

    // Mostrar una venta específica
    public function show(Venta $venta): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $venta,
            'message' => 'Venta obtenida exitosamente'
        ]);
    }

    // Actualizar venta
    public function update(VentaRequest $request, Venta $venta): JsonResponse
    {
        $venta->update($request->validated());

        return response()->json([
            'success' => true,
            'data' => $venta,
            'message' => 'Venta actualizada exitosamente'
        ]);
    }

    // Eliminar venta (soft delete)
    public function destroy(Venta $venta): JsonResponse
    {
        $venta->delete();

        return response()->json([
            'success' => true,
            'message' => 'Venta eliminada exitosamente'
        ]);
    }

    // Restaurar venta eliminada
    public function restore($id): JsonResponse
    {
        $venta = Venta::withTrashed()->findOrFail($id);
        $venta->restore();

        return response()->json([
            'success' => true,
            'message' => 'Venta restaurada exitosamente'
        ]);
    }

    // Obtener estadísticas
    public function estadisticas(): JsonResponse
    {
        $totalVentas = Venta::count();
        $ventasPagadas = Venta::where('estado', 'pagado')->count();
        $ingresosTotales = Venta::where('estado', 'pagado')->sum('total');
        $ventaPromedio = $ingresosTotales > 0 ? $ingresosTotales / $ventasPagadas : 0;

        return response()->json([
            'success' => true,
            'data' => [
                'total_ventas' => $totalVentas,
                'ventas_pagadas' => $ventasPagadas,
                'ingresos_totales' => $ingresosTotales,
                'venta_promedio' => round($ventaPromedio, 2)
            ]
        ]);
    }
}