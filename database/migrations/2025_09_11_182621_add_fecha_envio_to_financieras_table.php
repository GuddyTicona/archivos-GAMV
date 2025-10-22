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
        Schema::table('financieras', function (Blueprint $table) {
            $table->date('fecha_envio')->nullable()->after('area_id');
        });
    }

    public function down()
    {
        Schema::table('financieras', function (Blueprint $table) {
            $table->dropColumn('fecha_envio');
        });
    }

};
