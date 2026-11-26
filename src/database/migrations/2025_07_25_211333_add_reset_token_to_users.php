<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            //$table->integer('reset_token')->after('precio')->default(1)->comment('Número de cuartos del inmueble');
            $table->string('reset_token', 60)->nullable()->after('password')->comment('Token de restablecimiento de contraseña');
            //fecha y hora de expiración del token de restablecimiento de contraseña
            $table->timestamp('reset_token_expiry')->nullable()->after('reset_token')->comment('Fecha de expiración del token de restablecimiento de contraseña');
            // El campo 'reset
            //$table->date('reset_token_expiry')->nullable()->after('reset_token')->comment('Fecha de expiración del token de restablecimiento de contraseña');
            // El token de restablecimiento de contraseña es una cadena de 60 caracteres y puede ser nulo.
            // Se coloca después del campo 'password' para mantener la estructura de la tabla.
            // Este campo se utilizará para almacenar el token generado para el restablecimiento de contraseña de los usuarios.
            // Esto permite que los usuarios puedan solicitar un restablecimiento de contraseña y recibir un enlace
            // para cambiar su contraseña de manera segura.
            // Asegúrate de que el campo 'reset_token' sea único si es necesario
            // para evitar conflictos en el proceso de restablecimiento de contraseña.
            //$table->index('reset_token', 'idx_reset_token'); // Agregar un índice
            // para mejorar el rendimiento de las consultas que busquen por este campo.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('reset_token'); // Eliminar el campo 'reset_token' si es necesario revertir la migración.
            $table->dropColumn('reset_token_expiry'); // Eliminar el campo 'reset_token_expiry' si es necesario revertir la migración.
        });
    }
};
