<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inmueble;

class HomeController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function dashboard()
    {
        $totalInmuebles = Inmueble::count();
        $inmueblesDisponibles = Inmueble::where('disponibilidad', true)->count();
        $inmueblesRenta = Inmueble::where('tipo', 'Renta')->count();
        $inmueblesVenta = Inmueble::where('tipo', 'Venta')->count();

        return view('dashboard.index', compact(
            'totalInmuebles',
            'inmueblesDisponibles', 
            'inmueblesRenta',
            'inmueblesVenta'
        ));
    }
}