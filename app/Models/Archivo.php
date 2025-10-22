<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;

/**
 * Class Archivo
 *
 * @property $id
 * @property $codigo_archivo
 * @property $descripcion_documento
 * @property $tomo
 * @property $numero_foja
 * @property $gestion
 * @property $unidad_instalacion
 * @property $observaciones
 * @property $fecha_registro
 * @property $unidad_id
 * @property $estado
 * @property $categoria_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Categoria $categoria
 * @property Unidad $unidad
 * @property HistorialArchivo[] $historialArchivos
 * @property HistorialArchivo[] $historialArchivos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Archivo extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['codigo_archivo', 'descripcion_documento', 'tomo', 'numero_foja', 'gestion', 'unidad_instalacion', 'observaciones', 'fecha_registro', 'unidad_id', 'estado', 'categoria_id','documento_adjunto'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categorias()
    {
        return $this->belongsTo(\App\Models\Categoria::class, 'categoria_id', 'id');
    }
    
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unidad()
    {
        return $this->belongsTo(\App\Models\Unidad::class, 'unidad_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function historialArchivos()
    {
        return $this->hasMany(\App\Models\HistorialArchivo::class, 'id', 'archivo_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
  

   
    
}
