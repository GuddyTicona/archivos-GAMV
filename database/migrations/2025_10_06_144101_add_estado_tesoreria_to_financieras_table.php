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
       
            $table->enum('estado_tesoreria', ['enviado', 'pendiente', 'recibido', 'rechazado'])
                  ->default('enviado')
                  ->after('estado_despacho');

            $table->timestamp('tesoreria_actualizado')->nullable()
                  ->after('estado_tesoreria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('financieras', function (Blueprint $table) {
            $table->dropColumn(['estado_tesoreria', 'tesoreria_actualizado']);
        });
    }
};
