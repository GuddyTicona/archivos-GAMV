<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unidad>
 */
class UnidadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'nombre_unidad'=>'Administracion financiera',
            'descripcion'=>'Gestion de datos en contabilidad',
            'fecha_creacion'=>'2025-03-30 17:20:00'
        ];
    }
}
