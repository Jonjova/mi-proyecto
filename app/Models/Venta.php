<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ventas';
    
    protected $fillable = [
        'cliente_nombre',
        'cliente_email',
        'cliente_telefono',
        'producto',
        'cantidad',
        'precio_unitario',
        'subtotal',
        'impuesto',
        'total',
        'metodo_pago',
        'estado',
        'fecha_venta',
        'notas'
    ];

    protected $casts = [
        'cantidad' => 'integer',
        'precio_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'impuesto' => 'decimal:2',
        'total' => 'decimal:2',
        'fecha_venta' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Accesor para formatear el total
    public function getTotalFormateadoAttribute(): string
    {
        return '$' . number_format($this->total, 2);
    }

    // Mutador para cantidad
    public function setCantidadAttribute($value)
    {
        $this->attributes['cantidad'] = $value;
        $this->calcularTotales();
    }

    // Mutador para precio unitario
    public function setPrecioUnitarioAttribute($value)
    {
        $this->attributes['precio_unitario'] = $value;
        $this->calcularTotales();
    }

    // Mutador para impuesto
    public function setImpuestoAttribute($value)
    {
        $this->attributes['impuesto'] = $value ?? 0;
        $this->calcularTotales();
    }

    // Método para calcular totales (versión corregida)
    private function calcularTotales()
    {
        // Verificar que existan las claves necesarias
        $cantidad = $this->attributes['cantidad'] ?? 0;
        $precioUnitario = $this->attributes['precio_unitario'] ?? 0;
        $impuesto = $this->attributes['impuesto'] ?? 0;
        
        // Calcular subtotal y total
        $subtotal = $cantidad * $precioUnitario;
        $total = $subtotal + $impuesto;
        
        // Asignar los valores calculados
        $this->attributes['subtotal'] = $subtotal;
        $this->attributes['total'] = $total;
    }
}