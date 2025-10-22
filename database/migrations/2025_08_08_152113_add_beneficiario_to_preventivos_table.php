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
    Schema::table('preventivos', function (Blueprint $table) {
        $table->string('beneficiario', 150)->nullable()->after('empresa');
    });
}

public function down()
{
    Schema::table('preventivos', function (Blueprint $table) {
        $table->dropColumn('beneficiario');
    });
}

};
