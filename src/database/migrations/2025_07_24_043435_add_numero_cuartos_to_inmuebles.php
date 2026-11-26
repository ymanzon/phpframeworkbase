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
        Schema::table('inmuebles', function (Blueprint $table) {
            //
            $table->integer('numero_cuartos')->after('precio')->default(1)->comment('Número de cuartos del inmueble');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inmuebles', function (Blueprint $table) {
            //
            $table->dropColumn('numero_cuartos');
        });
    }
};
