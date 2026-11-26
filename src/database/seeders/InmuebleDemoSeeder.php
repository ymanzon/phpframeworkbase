<?php

namespace Database\Seeders;

use App\Models\Inmueble;
use Illuminate\Database\Seeder;

class InmuebleDemoSeeder extends Seeder
{
    /**
     * 9 propiedades demo de Mérida (Hábitat Mérida, identidad ficticia).
     * Mapeadas desde database/seeders/data/propiedades-demo.json a las
     * columnas reales de la tabla inmuebles. Las fotos son nombres de
     * ejemplo: sustitúyelos por imágenes reales o de stock antes de vender.
     * numero_pisos no viene en el JSON: se usa 1 por defecto (terrenos 0).
     */
    public function run(): void
    {
        $demo = [
            ['nombre' => 'Casa en privada en Temozón Norte', 'precio' => 5850000, 'numero_cuartos' => 4, 'numero_banos' => 3, 'numero_pisos' => 2, 'tamano_construccion' => 210, 'tamano_terreno' => 320, 'ciudad' => 'Merida', 'descripcion' => 'Casa de dos plantas en privada con caseta, cerca del Periférico y de Plaza Altabrisa. Sala-comedor amplia, cocina integral, terraza, alberca y cochera para 2 autos.', 'tipo' => 'Venta'],
            ['nombre' => 'Casa nueva en Cholul', 'precio' => 3850000, 'numero_cuartos' => 3, 'numero_banos' => 2, 'numero_pisos' => 1, 'tamano_construccion' => 160, 'tamano_terreno' => 240, 'ciudad' => 'Merida', 'descripcion' => 'Casa nueva en privada, a 15 minutos de Altabrisa. 3 recámaras, cocina con barra, patio trasero y cochera techada. Acepta crédito Infonavit y bancario.', 'tipo' => 'Venta'],
            ['nombre' => 'Departamento amueblado en García Ginerés', 'precio' => 11000, 'numero_cuartos' => 2, 'numero_banos' => 1, 'numero_pisos' => 1, 'tamano_construccion' => 78, 'tamano_terreno' => 78, 'ciudad' => 'Merida', 'descripcion' => 'Departamento amueblado de 2 recámaras cerca de Av. Colón, Parque de las Américas y Paseo de Montejo. Cocina integral, sala-comedor y área de lavado. Ideal para pareja o profesionista.', 'tipo' => 'Renta'],
            ['nombre' => 'Casa amplia en Altabrisa', 'precio' => 5200000, 'numero_cuartos' => 4, 'numero_banos' => 3, 'numero_pisos' => 2, 'tamano_construccion' => 235, 'tamano_terreno' => 360, 'ciudad' => 'Merida', 'descripcion' => 'Casa amplia en zona consolidada del norte, cerca de plazas, hospitales y colegios. Recámara principal con vestidor, jardín, terraza y cochera para 2 autos.', 'tipo' => 'Venta'],
            ['nombre' => 'Casa en renta en Temozón Norte', 'precio' => 23000, 'numero_cuartos' => 3, 'numero_banos' => 3, 'numero_pisos' => 2, 'tamano_construccion' => 195, 'tamano_terreno' => 300, 'ciudad' => 'Merida', 'descripcion' => 'Casa en renta en privada con alberca y áreas verdes, cerca de Cabo Norte y del Periférico. 3 recámaras, cocina equipada, estudio y cochera para 2 autos. Mantenimiento incluido.', 'tipo' => 'Renta'],
            ['nombre' => 'Terreno habitacional en Conkal', 'precio' => 950000, 'numero_cuartos' => 0, 'numero_banos' => 0, 'numero_pisos' => 0, 'tamano_construccion' => 0, 'tamano_terreno' => 450, 'ciudad' => 'Merida', 'descripcion' => 'Terreno plano de 15 x 30 m en zona habitacional en crecimiento, con todos los servicios. Ideal para construir casa familiar o para inversión.', 'tipo' => 'Venta'],
            ['nombre' => 'Casa colonial en Centro Histórico', 'precio' => 4200000, 'numero_cuartos' => 3, 'numero_banos' => 2, 'numero_pisos' => 1, 'tamano_construccion' => 185, 'tamano_terreno' => 260, 'ciudad' => 'Merida', 'descripcion' => 'Casa colonial remodelada a unas cuadras de Paseo de Montejo, con patio interior, techos altos y acabados tradicionales. 3 recámaras, cocina integral y terraza.', 'tipo' => 'Venta'],
            ['nombre' => 'Departamento amueblado en Montebello', 'precio' => 12000, 'numero_cuartos' => 1, 'numero_banos' => 1, 'numero_pisos' => 1, 'tamano_construccion' => 62, 'tamano_terreno' => 62, 'ciudad' => 'Merida', 'descripcion' => 'Departamento amueblado de 1 recámara en el norte de Mérida, listo para habitar. Cocina equipada, área de lavado y estacionamiento. Ideal para profesionista o pareja.', 'tipo' => 'Renta'],
            ['nombre' => 'Casa con jardín en Caucel', 'precio' => 1850000, 'numero_cuartos' => 3, 'numero_banos' => 2, 'numero_pisos' => 1, 'tamano_construccion' => 110, 'tamano_terreno' => 200, 'ciudad' => 'Merida', 'descripcion' => 'Casa de una planta con jardín amplio y estacionamiento para 2 autos, cerca de escuelas y comercios. Buena opción para primera vivienda o inversión en renta.', 'tipo' => 'Venta'],
        ];

        foreach ($demo as $d) {
            Inmueble::create(array_merge($d, [
                'fotos' => [],
                'disponibilidad' => true,
            ]));
        }
    }
}
