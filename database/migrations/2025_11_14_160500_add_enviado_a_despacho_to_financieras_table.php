<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('financieras', function (Blueprint $table) {
            $table->boolean('enviado_a_despacho')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('financieras', function (Blueprint $table) {
            $table->dropColumn('enviado_a_despacho');
        });
    }
};
