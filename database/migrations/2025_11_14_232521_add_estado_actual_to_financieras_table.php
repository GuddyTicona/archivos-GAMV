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
            $table->string('estado_actual')->default('smaf');
        });
    }

    public function down()
    {
        Schema::table('financieras', function (Blueprint $table) {
            $table->dropColumn('estado_actual');
        });
    }

};
