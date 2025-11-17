<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;
    
    protected $table = 'notificaciones';

    protected $fillable = [
        'financiera_id',
        'de_area',
        'para_area',
        'mensaje',
        'leido',
    ];

   
    protected $casts = [
        'leido' => 'boolean',
    ];

    public function financiera()
    {
        return $this->belongsTo(Financiera::class);
    }
}