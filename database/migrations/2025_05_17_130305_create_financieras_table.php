<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('financieras', function (Blueprint $table) {
 $table->id();

        // Información general
        $table->string('entidad', 255);
        $table->foreignId('unidad_id')->nullable()->constrained('unidades');
        // Descripción y clasificación del gasto
        $table->text('descripcion_gasto')->nullable();
        // Valores monetarios
        $table->decimal('total_pago', 12, 2)->default(0);
        // Estado y tipo de documentos
        $table->enum('estado_documento', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');
        $table->string('tipo_documento', 50);
        $table->string('tipo_ejecucion', 50);

        // Fechas
        $table->date('fecha_documento')->nullable();

        // Documentos adjuntos (PDF, Word, Excel, etc.)
        $table->string('documento_adjunto')->nullable(); // NUEVO campo para archivo

        // Datos de control de flujo
        $table->string('numero_hoja_ruta', 50)->nullable();
        $table->string('numero_preventivo', 50)->nullable();
        $table->string('numero_compromiso', 50)->nullable();
        $table->string('numero_devengado', 50)->nullable();
        $table->string('numero_pago', 50)->nullable();
        $table->string('numero_secuencia', 50)->nullable();

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financieras');
    }
};
