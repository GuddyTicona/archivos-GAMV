<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('preventivos', function (Blueprint $table) {
            // Cambiar numero_secuencia a string de 50 caracteres
            $table->string('numero_secuencia', 50)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('preventivos', function (Blueprint $table) {
            // Revertir a integer solo si quieres (opcional)
            $table->integer('numero_secuencia')->nullable()->change();
        });
    }
};
