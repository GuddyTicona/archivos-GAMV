<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('preventivos', function (Blueprint $table) {
            $table->id();

            // Relación con la tabla financieras
            $table->foreignId('financiera_id')->constrained('financieras')->onDelete('cascade');

            // Datos específicos del preventivo
            $table->string('numero_preventivo', 50);
            $table->decimal('total_pago', 12, 3)->default(0);
            $table->text('descripcion_gasto')->nullable();
            $table->string('empresa')->nullable();
            $table->string('numero_secuencia', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('preventivos');
    }
};
