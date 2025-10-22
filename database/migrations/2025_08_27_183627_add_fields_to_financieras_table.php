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
            // Código único de archivo
            $table->string('codigo')->nullable()->unique()->after('id');

            // Estado de si ya fue enviado a archivos
            $table->enum('enviado_archivo', ['pendiente', 'enviado'])
                  ->default('pendiente')
                  ->after('codigo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('financieras', function (Blueprint $table) {
            //
            $table->dropColumn(['codigo', 'enviado_archivo']);
        });
    }
};
