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
        Schema::table('financieras', function (Blueprint $table) {
            //
             $table->enum('estado_despacho', ['enviado', 'pendiente', 'recibido', 'rechazado'])->default('enviado'); 
            // Campo para registrar cuándo se actualizó el estado
            $table->timestamp('despacho_actualizado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('financieras', function (Blueprint $table) {
            $table->dropColumn(['estado_despacho', 'despacho_actualizado']);
        });
    }
};
