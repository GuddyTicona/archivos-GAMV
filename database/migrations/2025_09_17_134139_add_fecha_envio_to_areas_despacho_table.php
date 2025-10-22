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
        Schema::table('areas_despacho', function (Blueprint $table) {
            //
             $table->date('fecha_envio')->nullable()->after('descripcion'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('areas_despacho', function (Blueprint $table) {
            //
             $table->dropColumn('fecha_envio');
        });
    }
};
