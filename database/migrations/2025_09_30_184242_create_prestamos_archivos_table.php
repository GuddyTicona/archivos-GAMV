<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestamos_archivos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financiera_id')
                  ->constrained('financieras')
                  ->onDelete('cascade'); // Si se borra la financiera, se borran los préstamos
            $table->string('solicitante'); // Persona o departamento
            $table->date('fecha_prestamo');
            $table->date('fecha_devolucion')->nullable(); // null = archivo aún prestado
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestamos_archivos');
    }
};
