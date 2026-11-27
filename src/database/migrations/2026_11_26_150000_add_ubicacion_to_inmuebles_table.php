<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Ubicación del inmueble para el selector de mapa (Leaflet).
// latitud/longitud se llenan desde el mapa al crear o editar el inmueble;
// direccion se llena sola por geocodificación inversa y se puede corregir a mano.
// Opcional: un inmueble sin ubicación sigue funcionando (columnas nullable).
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inmuebles', function (Blueprint $table) {
            $table->decimal('latitud', 10, 8)->nullable()->after('ciudad');
            $table->decimal('longitud', 11, 8)->nullable()->after('latitud');
            $table->string('direccion', 250)->nullable()->after('longitud');
        });
    }

    public function down(): void
    {
        Schema::table('inmuebles', function (Blueprint $table) {
            $table->dropColumn(['latitud', 'longitud', 'direccion']);
        });
    }
};
