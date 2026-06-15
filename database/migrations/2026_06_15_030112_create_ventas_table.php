<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('cliente_nombre', 100);
            $table->string('cliente_email', 100)->nullable();
            $table->string('cliente_telefono', 20)->nullable();
            $table->string('producto', 150);
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('impuesto', 5, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->string('metodo_pago', 50)->default('efectivo');
            $table->enum('estado', ['pendiente', 'pagado', 'cancelado'])->default('pendiente');
            $table->date('fecha_venta');
            $table->text('notas')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Para borrado lógico
            
            // Índices para optimizar búsquedas
            $table->index('cliente_nombre');
            $table->index('estado');
            $table->index('fecha_venta');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};