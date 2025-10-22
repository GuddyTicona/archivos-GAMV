<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prestamos_archivos', function (Blueprint $table) {
            $table->string('cargo_departamento')->nullable()->after('solicitante');
            $table->text('motivo_prestamo')->nullable()->after('fecha_prestamo');
            $table->text('observaciones')->nullable()->after('motivo_prestamo');
        });
    }

    public function down(): void
    {
        Schema::table('prestamos_archivos', function (Blueprint $table) {
            $table->dropColumn(['cargo_departamento', 'motivo_prestamo', 'observaciones']);
        });
    }
};
