<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestamoArchivocentral extends Model
{
    use HasFactory;
      protected $table = 'prestamo_archivocentral';

    protected $fillable = [
        'archivo_id',
        'solicitante',
        'cargo_departamento',
        'fecha_prestamo',
        'fecha_devolucion',
        'motivo_prestamo',
        'observaciones',
    ];

    public function archivo()
    {
        return $this->belongsTo(Archivo::class, 'archivo_id');
    }

 


}
