<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inmueble;

class InmueblesController extends Controller
{
    public function index()
    {
        try {
            $inmuebles = Inmueble::all();
            
            return response()->json([
                'success' => true, 
                'data'=> $inmuebles 
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['success'=> false, 'error' => 'Error fetching inmuebles: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $inmueble = Inmueble::findOrFail($id);
            return response()->json(['success' => true, 'data' => $inmueble], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Inmueble not found: ' . $e->getMessage()], 404);
        }
    }   
}