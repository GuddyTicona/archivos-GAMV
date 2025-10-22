<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ubicaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financiera_id')
                  ->constrained('financieras')
                  ->onDelete('cascade'); // Si se borra la financiera, se borra la ubicación
            $table->string('estante'); // Ej: Estante A
            $table->integer('fila');
            $table->integer('columna');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ubicaciones');
    }
};
