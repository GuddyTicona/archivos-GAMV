<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('financieras', function (Blueprint $table) {
            $table->foreignId('area_despacho_id')->nullable()->constrained('areas_despacho')->onDelete('set null');
            $table->foreignId('area_archivo_id')->nullable()->constrained('areas_archivos')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('financieras', function (Blueprint $table) {
            $table->dropForeign(['area_despacho_id']);
            $table->dropForeign(['area_archivo_id']);
            $table->dropColumn(['area_despacho_id', 'area_archivo_id']);
        });
    }
};
