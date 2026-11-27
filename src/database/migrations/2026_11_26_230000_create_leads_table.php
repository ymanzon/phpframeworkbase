<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Leads del formulario de contacto (público y ficha de propiedad).
     * Se avisa por correo y/o Telegram según config('inmobiliaria.leads.canales').
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('correo', 150);
            $table->string('telefono', 30)->nullable();
            $table->text('mensaje');
            $table->foreignId('inmueble_id')->nullable()->constrained('inmuebles')->nullOnDelete();
            $table->string('origen', 50)->nullable(); // contacto | ficha
            $table->boolean('leido')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
