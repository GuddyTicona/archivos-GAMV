<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaArchivo extends Model
{
    protected $table = 'areas_archivos';

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function financieras()
    {
        return $this->hasMany(Financiera::class, 'area_archivo_id');
    }
}
