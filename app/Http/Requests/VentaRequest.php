<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cambiar según lógica de autenticación
    }

    public function rules(): array
    {
        $rules = [
            'cliente_nombre' => 'required|string|max:100',
            'cliente_email' => 'nullable|email|max:100',
            'cliente_telefono' => 'nullable|string|max:20',
            'producto' => 'required|string|max:150',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'impuesto' => 'nullable|numeric|min:0|max:100',
            'metodo_pago' => 'required|in:efectivo,tarjeta,transferencia',
            'estado' => 'nullable|in:pendiente,pagado,cancelado',
            'fecha_venta' => 'required|date',
            'notas' => 'nullable|string|max:500'
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            // Para actualización, hacer campos opcionales
            $rules = array_map(function ($rule) {
                return str_replace('required', 'sometimes', $rule);
            }, $rules);
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'cliente_nombre.required' => 'El nombre del cliente es obligatorio',
            'producto.required' => 'El producto es obligatorio',
            'cantidad.min' => 'La cantidad debe ser al menos 1',
            'precio_unitario.min' => 'El precio unitario no puede ser negativo',
            'metodo_pago.in' => 'Método de pago no válido'
        ];
    }
}