<?php

namespace Database\Seeders;

use App\Models\Unidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Unidad::create([
            'nombre_unidad'=>'Almacenes',
            'descripcion'=>'compra de discos solidos',
            'fecha_creacion'=>'2025-03-30'

        ]);
    
    }
}
