<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Financiera;

class Preventivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'financiera_id',
        'numero_preventivo',
        'total_pago',
        'descripcion_gasto',
        'empresa',
        'beneficiario',
        'numero_secuencia',
         
    ];

    public function financiera()
    {
        return $this->belongsTo(Financiera::class);
    }
}

