<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('financieras', function (Blueprint $table) {
            $table->enum('estado_administrativo', ['enviado', 'pendiente', 'recibido', 'rechazado'])->default('enviado');
            $table->timestamp('estado_actualizado')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('financieras', function (Blueprint $table) {
            $table->dropColumn('estado_administrativo');
            $table->dropColumn('estado_actualizado');
        });
    }
};
