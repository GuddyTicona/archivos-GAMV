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
        Schema::create('prestamo_archivocentral', function (Blueprint $table) {
        $table->id();
        $table->foreignId('archivo_id')->constrained('archivos')->onDelete('cascade');
        $table->string('solicitante');
        $table->string('cargo_departamento')->nullable();
        $table->date('fecha_prestamo');
        $table->date('fecha_devolucion')->nullable();
        $table->text('motivo_prestamo')->nullable();
        $table->text('observaciones')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamo_archivocentral');
    }
};
