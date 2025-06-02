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
        Schema::create('historial_archivos', function (Blueprint $table) {
           $table->id();
            $table->foreignId('archivo_id')->constrained('archivos');
            $table->foreignId('user_id')->constrained('users');
            $table->string('tipo_evento', 100);
            $table->text('observaciones')->nullable();
            $table->foreignId('id_financiera')->nullable()->constrained('financieras');
            $table->date('fecha')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_archivos');
    }
};
