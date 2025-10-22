<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;
     protected $table = 'ubicaciones'; 

    protected $fillable = [
        'financiera_id',
        'estante',
        'fila',
        'columna',
       
    ];

    public function financieras()
    {
        return $this->hasMany(Financiera::class);
    }
}
