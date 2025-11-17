<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('notificaciones', function (Blueprint $table) {
            $table->text('mensaje')->change();
        });
    }

    public function down()
    {
        Schema::table('notificaciones', function (Blueprint $table) {
            $table->string('mensaje', 255)->change();
        });
    }
};
