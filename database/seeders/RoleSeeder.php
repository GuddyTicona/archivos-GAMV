<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar la caché de permisos
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear roles
        $roles = ['administrador', 'smaf', 'despacho', 'tesoreria', 'archivos'];
        foreach ($roles as $rol) {
            Role::firstOrCreate(['name' => $rol]);
        }

        

        // Limpiar cache nuevamente (opcional pero recomendable)
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
