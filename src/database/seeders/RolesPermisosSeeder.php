<?php

namespace Database\Seeders;

use App\Models\Permiso;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// Roles y permisos de la plantilla (esquema propio, sin paquetes).
// Administrador: todos los permisos. Agente: panel y gestión de inmuebles
// (crear y editar, sin eliminar ni gestionar usuarios/roles).
// Cliente: panel e inmuebles solo para ver.
// Usuarios demo (cámbialos antes de entregar a un cliente real):
// agente@habitatmerida.mx / agente123, cliente@habitatmerida.mx / cliente123.
// El admin admin@habitatmerida.mx / admin123 se crea en DatabaseSeeder.
class RolesPermisosSeeder extends Seeder
{
    public function run(): void
    {
        $permisos = [
            'Panel' => [
                'dashboard.ver' => 'Ver panel',
            ],
            'Inmuebles' => [
                'inmuebles.ver' => 'Ver inmuebles',
                'inmuebles.crear' => 'Crear inmuebles',
                'inmuebles.editar' => 'Editar inmuebles',
                'inmuebles.eliminar' => 'Eliminar inmuebles',
            ],
            'Usuarios' => [
                'usuarios.ver' => 'Ver usuarios',
                'usuarios.crear' => 'Crear usuarios',
                'usuarios.editar' => 'Editar usuarios',
                'usuarios.eliminar' => 'Eliminar usuarios',
            ],
            'Roles' => [
                'roles.ver' => 'Ver roles',
                'roles.crear' => 'Crear roles',
                'roles.editar' => 'Editar roles',
                'roles.eliminar' => 'Eliminar roles',
            ],
        ];

        foreach ($permisos as $grupo => $lista) {
            foreach ($lista as $nombre => $etiqueta) {
                Permiso::firstOrCreate(
                    ['nombre' => $nombre],
                    ['etiqueta' => $etiqueta, 'grupo' => $grupo]
                );
            }
        }

        $roles = [
            'administrador' => ['etiqueta' => 'Administrador', 'descripcion' => 'Acceso total al panel y a la gestión de usuarios y roles.', 'permisos' => 'todos'],
            'agente' => ['etiqueta' => 'Agente', 'descripcion' => 'Gestiona inmuebles: crea y edita, sin eliminar ni administrar usuarios.', 'permisos' => ['dashboard.ver', 'inmuebles.ver', 'inmuebles.crear', 'inmuebles.editar']],
            'cliente' => ['etiqueta' => 'Cliente', 'descripcion' => 'Solo consulta el panel y el listado de inmuebles.', 'permisos' => ['dashboard.ver', 'inmuebles.ver']],
        ];

        foreach ($roles as $nombre => $datos) {
            $rol = Rol::firstOrCreate(
                ['nombre' => $nombre],
                ['etiqueta' => $datos['etiqueta'], 'descripcion' => $datos['descripcion']]
            );
            $ids = $datos['permisos'] === 'todos'
                ? Permiso::pluck('id')->all()
                : Permiso::whereIn('nombre', $datos['permisos'])->pluck('id')->all();
            $rol->permisos()->sync($ids);
        }

        $admin = User::where('email', 'admin@habitatmerida.mx')->first();
        if ($admin) {
            $admin->roles()->syncWithoutDetaching(
                Rol::where('nombre', 'administrador')->pluck('id')->all()
            );
        }

        $agente = User::firstOrCreate(
            ['email' => 'agente@habitatmerida.mx'],
            ['name' => 'agente', 'password' => Hash::make('agente123')]
        );
        $agente->roles()->syncWithoutDetaching(
            Rol::where('nombre', 'agente')->pluck('id')->all()
        );

        $cliente = User::firstOrCreate(
            ['email' => 'cliente@habitatmerida.mx'],
            ['name' => 'cliente', 'password' => Hash::make('cliente123')]
        );
        $cliente->roles()->syncWithoutDetaching(
            Rol::where('nombre', 'cliente')->pluck('id')->all()
        );
    }
}
