<?php
namespace Database\Seeders;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@sistema.com'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('admin123'), 
                  'fecha_ingreso' => Carbon::now(),
                   'estado' => 'activo', 
            ]
        );

        $admin->assignRole('administrador');
    }
}
