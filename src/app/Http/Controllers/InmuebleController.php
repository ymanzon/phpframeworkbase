<?php

namespace App\Http\Controllers;

use App\Models\Inmueble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InmuebleController extends Controller
{
    public function index(Request $request)
    {
        $query = Inmueble::query();
        if ($request->has('tipo') && $request->tipo != '') {
            $query->where('tipo', $request->tipo);
        }

        if ($request->has('ciudad') && $request->ciudad != '') {
            $query->where('ciudad', $request->ciudad);
        }

        if ($request->has('disponibilidad') && $request->disponibilidad != '' ) {
            $query->where('disponibilidad', $request->disponibilidad ); 
        }

        $query->orderBy('created_at', 'desc');
        $inmuebles = $query->paginate(10)->appends($request->query());
        return view('inmuebles.index', compact('inmuebles'));
    }

    public function create()
    {
        return view('inmuebles.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:250',
            'precio' => 'required|numeric|min:0',
            'numero_cuartos' => 'required|integer|min:1',
            'numero_banos' => 'required|numeric|min:1',
            'numero_pisos' => 'required|integer|min:1',
            'tamano_construccion' => 'required|numeric|min:0',
            'tamano_terreno' => 'required|numeric|min:0',
            'ciudad' => 'required|in:Merida,Monterrey,Campeche,Progreso',
            'descripcion' => 'required|string',
            'disponibilidad' => 'sometimes|boolean',
            'tipo' => 'required|in:Renta,Venta',
            'fotos' => 'required|array|max:10|min:1',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'numero_banos.required' => 'El número de baños es obligatorio.',
            'numero_pisos.required' => 'El número de pisos es obligatorio.',
            'fotos.max' => 'Máximo 10 fotos permitidas.',
            'fotos.*.image' => 'Cada archivo debe ser una imagen.',
            'fotos.*.max' => 'Cada imagen no debe exceder 2MB.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['disponibilidad'] = $request->has('disponibilidad');

        // Procesar fotos
        if ($request->hasFile('fotos')) {
            $fotos = [];
            foreach ($request->file('fotos') as $foto) {
                $path = $foto->store('inmuebles', 'public');
                $fotos[] = $path;
            }
            $data['fotos'] = $fotos;
        }

        Inmueble::create($data);

        return redirect()->route('inmuebles.index')
            ->with('success', 'Inmueble creado exitosamente.');
    }

    public function show(Inmueble $inmueble)
    {
        return view('inmuebles.show', compact('inmueble'));
    }

    public function edit(Inmueble $inmueble)
    {
        return view('inmuebles.edit', compact('inmueble'));
    }

    public function update(Request $request, Inmueble $inmueble)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:250',
            'precio' => 'required|numeric|min:0',
            'numero_cuartos' => 'required|integer|min:1',
            'numero_banos' => 'required|numeric|min:1',
            'numero_pisos' => 'required|integer|min:1',
            'tamano_construccion' => 'required|numeric|min:0',
            'tamano_terreno' => 'required|numeric|min:0',
            'ciudad' => 'required|in:Merida,Monterrey,Campeche,Progreso',
            'descripcion' => 'required|string',
            'disponibilidad' => 'sometimes|boolean',
            'tipo' => 'required|in:Renta,Venta',
            'fotos' => 'nullable|array|max:10',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ],
        [
            'nombre.required' => 'El nombre es obligatorio.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'numero_banos.required' => 'El número de baños es obligatorio.',
            'numero_pisos.required' => 'El número de pisos es obligatorio.',
            'fotos.max' => 'Máximo 10 fotos permitidas.',
            'fotos.*.image' => 'Cada archivo debe ser una imagen.',
            'fotos.*.max' => 'Cada imagen no debe exceder 2MB.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['disponibilidad'] = $request->has('disponibilidad');

        // Procesar nuevas fotos
        if ($request->hasFile('fotos')) {
            $fotosExistentes = $inmueble->fotos ?? [];
            $fotosNuevas = [];
            
            foreach ($request->file('fotos') as $foto) {
                $path = $foto->store('inmuebles', 'public');
                $fotosNuevas[] = $path;
            }
            
            // Combinar fotos existentes con nuevas (máximo 10)
            $todasLasFotos = array_merge($fotosExistentes, $fotosNuevas);
            $data['fotos'] = array_slice($todasLasFotos, 0, 10); // Limitar a 10 fotos
        }

        $inmueble->update($data);

        return redirect()->route('inmuebles.index')
            ->with('success', 'Inmueble actualizado exitosamente.');
    }

    public function destroy(Inmueble $inmueble)
    {
        // Eliminar fotos del storage
        if ($inmueble->fotos) {
            foreach ($inmueble->fotos as $foto) {
                Storage::disk('public')->delete($foto);
            }
        }

        $inmueble->delete();

        return redirect()->route('inmuebles.index')
            ->with('success', 'Inmueble eliminado exitosamente.');
    }

    public function deleteFoto(Inmueble $inmueble, $index)
    {
        $fotos = $inmueble->fotos ?? [];
        
        if (isset($fotos[$index])) {
            // Eliminar archivo del storage
            Storage::disk('public')->delete($fotos[$index]);
            
            // Remover de array
            unset($fotos[$index]);
            $fotos = array_values($fotos); // Reindexar array
            
            // Actualizar inmueble
            $inmueble->update(['fotos' => $fotos]);
            
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 404);
    }

    public function showDetail($id)
    {
        return view('inmuebles.detail', compact('id'));
    }
}