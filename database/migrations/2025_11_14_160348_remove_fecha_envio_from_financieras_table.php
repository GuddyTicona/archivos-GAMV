<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('financieras', function (Blueprint $table) {
            $table->dropColumn('fecha_envio');
        });
    }

    public function down(): void
    {
        Schema::table('financieras', function (Blueprint $table) {
            $table->timestamp('fecha_envio')->nullable();
        });
    }
};
