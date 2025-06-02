<?php

namespace Database\Seeders;
use App\Models\User;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar caché de permisos
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // OPCIONAL: Limpiar tablas (solo en desarrollo)
        // DB::table('role_has_permissions')->delete();
        // DB::table('model_has_roles')->delete();
        // DB::table('model_has_permissions')->delete();
        // Role::truncate();
        // Permission::truncate();

        // Crear roles si no existen
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $secretaria = Role::firstOrCreate(['name' => 'secretaria']);

        // Crear permisos y asignar roles
        Permission::firstOrCreate(['name' => 'index'])->syncRoles([$admin]);
        Permission::firstOrCreate(['name' => 'home'])->syncRoles([$admin, $secretaria]);
        Permission::firstOrCreate(['name' => 'unidades'])->syncRoles([$admin, $secretaria]);
        Permission::firstOrCreate(['name' => 'archivos'])->syncRoles([$admin]);
        Permission::firstOrCreate(['name' => 'categorias'])->syncRoles([$admin]);
        Permission::firstOrCreate(['name' => 'financieras'])->syncRoles([$admin]);
        Permission::firstOrCreate(['name' => 'historial-archivos'])->syncRoles([$admin]);
        Permission::firstOrCreate(['name' => 'usuarios'])->syncRoles([$admin]);


        //asignacion de los permisos 
       User::find(1)?->assignRole($admin);
       User::find(2)?->assignRole($secretaria);

    }
}
