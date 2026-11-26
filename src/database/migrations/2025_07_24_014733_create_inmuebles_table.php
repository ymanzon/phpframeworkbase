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
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 250);
            $table->json('fotos')->nullable(); // Array de hasta 4 fotos
            $table->decimal('precio', 12, 2);
            $table->integer('numero_banos');
            $table->integer('numero_pisos');
            $table->decimal('tamano_construccion', 10, 2); // m2
            $table->decimal('tamano_terreno', 10, 2); // m2
            $table->enum('ciudad', ['Merida', 'Monterrey', 'Campeche', 'Progreso'])->default('Merida');
            $table->text('descripcion');
            $table->boolean('disponibilidad')->default(true);
            $table->enum('tipo', ['Renta', 'Venta']);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inmuebles');
    }
};
