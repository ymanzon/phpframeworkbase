<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Admin de PRUEBA para la plantilla (identidad ficticia Hábitat Mérida):
     * admin@habitatmerida.mx / admin123 — cámbialo antes de entregar la
     * plantilla a un cliente real. No se crea ningún usuario del cliente
     * anterior en esta plantilla.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@habitatmerida.mx',
            'password' => Hash::make('admin123'),
        ]);

        // Roles y permisos + usuarios demo agente/cliente (ver RolesPermisosSeeder).
        $this->call(RolesPermisosSeeder::class);

        $this->call(InmuebleDemoSeeder::class);
    }
}
