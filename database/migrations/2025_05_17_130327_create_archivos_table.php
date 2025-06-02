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
        Schema::create('archivos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_archivo', 50)->unique();
            $table->text('descripcion_documento')->nullable();
            $table->string('tomo', 100)->nullable();
            $table->string('numero_foja', 100)->nullable();
            $table->string('gestion', 50)->nullable();
            $table->string('unidad_instalacion', 255)->nullable();
            $table->text('observaciones')->nullable();
            $table->date('fecha_registro')->useCurrent();
            $table->foreignId('unidad_id')->nullable()->constrained('unidades');
            $table->string('estado', 50)->default('activo');
            $table->foreignId('categoria_id')->nullable()->constrained('categorias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archivos');
    }
};
