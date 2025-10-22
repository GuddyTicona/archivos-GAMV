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
    Schema::dropIfExists('ubicaciones');
}

public function down(): void
{
    Schema::create('ubicaciones', function (Blueprint $table) {
        $table->id();
        $table->string('estante');
        $table->integer('fila');
        $table->integer('columna');
        $table->timestamps();
    });
}

};
