<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Agrega 'tesoreria' y 'archivos' al enum
        DB::statement("ALTER TABLE financieras MODIFY estado_administrativo ENUM('enviado', 'pendiente', 'recibido', 'rechazado', 'tesoreria', 'archivos') DEFAULT 'enviado'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Quita 'tesoreria' y 'archivos', volviendo al estado original
        DB::statement("ALTER TABLE financieras MODIFY estado_administrativo ENUM('enviado', 'pendiente', 'recibido', 'rechazado') DEFAULT 'enviado'");
    }
};
