<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Financiera
 *
 * @property $id
 * @property $entidad
 * @property $unidad_id
 * @property $descripcion_gasto
 * @property $total_pago
 * @property $estado_documento
 * @property $tipo_documento
 * @property $tipo_ejecucion
 * @property $fecha_documento
 * @property $documento_adjunto
 * @property $numero_hoja_ruta
 * @property $numero_preventivo
 * @property $numero_compromiso
 * @property $numero_devengado
 * @property $numero_pago
 * @property $numero_secuencia
 * @property $created_at
 * @property $updated_at
 *
 * @property Unidad $unidad
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Financiera extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

protected $fillable = [
    'entidad',
    'unidad_id',
    'area_despacho_id',
    'area_archivo_id',
    'area_id',
    'estado_documento',
    'tipo_documento',
    'tipo_ejecucion',
    'fecha_documento',
    'documento_adjunto',
    'numero_hoja_ruta',
    'numero_compromiso',
    'numero_devengado',
    'numero_pago',
    'numero_foja',
    'estado_administrativo',
    'estado_actualizado',
    'descripcion_gasto',
    'total_pago',
    'estado_despacho',
    'despacho_actualizado',
    'codigo',
    'enviado_archivo',
    'ubicacion_id',
    
];


     protected $casts = [
        'estado_actualizado' => 'datetime',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unidad()
    {
        return $this->belongsTo(\App\Models\Unidad::class, 'unidad_id', 'id');
    }
//areas
   
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    //areas despacho
    public function areaDespacho()
    {
    return $this->belongsTo(AreaDespacho::class, 'area_despacho_id');
    }
    //areas archivos
    public function areaArchivo()
    {
    return $this->belongsTo(AreaArchivo::class, 'area_archivo_id');
    }

    //preventivos

     public function preventivos()
    {
        return $this->hasMany(Preventivo::class);
    }


     public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function prestamos()
    {
        return $this->hasMany(PrestamoArchivo::class);
    }

    public function ultimoPrestamo()
    {
        return $this->hasOne(PrestamoArchivo::class)->latestOfMany();
    }

    public function disponible()
    {
        $ultimo = $this->ultimoPrestamo;
        return !$ultimo || $ultimo->fecha_devolucion != null;
    }
}
