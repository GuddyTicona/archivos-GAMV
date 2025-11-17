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
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('financiera_id');
            $table->string('de_area');
            $table->string('para_area');
            $table->string('mensaje');
            $table->boolean('leido')->default(false);
            $table->timestamps();

            $table->foreign('financiera_id')->references('id')->on('financieras')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notificaciones');
    }

};
