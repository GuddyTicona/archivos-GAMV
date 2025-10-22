<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestamoArchivo extends Model
{
    use HasFactory;
     protected $table = 'prestamos_archivos';

    protected $fillable = [
        'financiera_id',
        'solicitante',
        'cargo_departamento',
        'fecha_prestamo',
        'fecha_devolucion',
        'motivo_prestamo',
        'observaciones',

    ];

   public function financiera()
    {
        return $this->belongsTo(Financiera::class);
    }

   public function estaPrestado()
    {
        return $this->fecha_devolucion === null;
    }
}
