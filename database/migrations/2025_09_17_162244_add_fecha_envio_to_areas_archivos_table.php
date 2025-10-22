<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('areas_archivos', function (Blueprint $table) {
        $table->date('fecha_envio')->nullable()->after('descripcion');
    });
}

public function down()
{
    Schema::table('areas_archivos', function (Blueprint $table) {
        $table->dropColumn('fecha_envio');
    });
}

};
