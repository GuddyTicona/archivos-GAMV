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
            $table->foreignId('ubicacion_id')
                  ->nullable()
                  ->constrained('ubicaciones')
                  ->onDelete('set null'); // Si se elimina la ubicación, poner null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('financieras', function (Blueprint $table) {
            $table->dropForeign(['ubicacion_id']);
            $table->dropColumn('ubicacion_id');
        });
    }
};
