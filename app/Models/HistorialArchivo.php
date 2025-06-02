<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class HistorialArchivo
 *
 * @property $id
 * @property $archivo_id
 * @property $user_id
 * @property $tipo_evento
 * @property $observaciones
 * @property $id_financiera
 * @property $fecha
 * @property $created_at
 * @property $updated_at
 *
 * @property Archivo $archivo
 * @property Financiera $financiera
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class HistorialArchivo extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['archivo_id', 'user_id', 'tipo_evento', 'observaciones', 'id_financiera', 'fecha'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function archivo()
    {
        return $this->belongsTo(\App\Models\Archivo::class, 'archivo_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function financiera()
    {
        return $this->belongsTo(\App\Models\Financiera::class, 'id_financiera', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
    
}
