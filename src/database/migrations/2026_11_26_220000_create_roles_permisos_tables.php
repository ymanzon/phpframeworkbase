<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Esquema propio de roles y permisos (sin paquetes).
// roles: administrador, agente, cliente (el seeder los crea).
// permisos: acciones como inmuebles.crear o usuarios.ver, agrupadas.
// permiso_rol y rol_usuario son las relaciones muchos a muchos.
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50)->unique(); // slug: administrador
            $table->string('etiqueta', 100); // nombre visible: Administrador
            $table->string('descripcion', 250)->nullable();
            $table->timestamps();
        });

        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique(); // slug: inmuebles.crear
            $table->string('etiqueta', 100); // nombre visible: Crear inmuebles
            $table->string('grupo', 50); // Inmuebles, Usuarios, Roles, Panel
            $table->timestamps();
        });

        Schema::create('permiso_rol', function (Blueprint $table) {
            $table->foreignId('rol_id')->constrained('roles')->cascadeOnDelete();
            $table->foreignId('permiso_id')->constrained('permisos')->cascadeOnDelete();
            $table->primary(['rol_id', 'permiso_id']);
        });

        Schema::create('rol_usuario', function (Blueprint $table) {
            $table->foreignId('rol_id')->constrained('roles')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->primary(['rol_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rol_usuario');
        Schema::dropIfExists('permiso_rol');
        Schema::dropIfExists('permisos');
        Schema::dropIfExists('roles');
    }
};
