<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financieras', function (Blueprint $table) {
            $table->id();

            // Información general
            $table->string('entidad', 255);
            $table->foreignId('unidad_id')->nullable()->constrained('unidades');
            // Estado y tipo de documentos
            $table->enum('estado_documento', ['pendiente', 'aprobado', 'rechazado','enviado'])->default('enviado');
            $table->string('tipo_documento', 50);
            $table->string('tipo_ejecucion', 50);
            // Fechas
            $table->date('fecha_documento')->nullable();
            // Documentos adjuntos llena tesoreria
            $table->string('documento_adjunto')->nullable();
            // Datos de control de flujo
           
            $table->string('numero_compromiso', 50)->nullable();
            $table->string('numero_devengado', 50)->nullable();
            $table->string('numero_pago', 50)->nullable();
     
            //llenado para despacho
           
            $table->string('numero_foja', 100)->nullable();
            $table->string('numero_hoja_ruta', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financieras');
    }
};
