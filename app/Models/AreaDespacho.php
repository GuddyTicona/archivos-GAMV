<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaDespacho extends Model
{
    protected $table = 'areas_despacho';  // Nombre exacto de la tabla en BD

    protected $fillable = ['nombre', 'descripcion'];  // para crear/actualizar en masa

    public function financieras()
    {
        return $this->hasMany(Financiera::class, 'area_despacho_id');
    }
}
