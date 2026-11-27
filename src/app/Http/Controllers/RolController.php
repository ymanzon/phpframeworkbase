<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

// Gestión de roles y sus permisos (solo quien tenga los permisos roles.*).
// Las rutas se protegen por acción en routes/web.php.
class RolController extends Controller
{
    public function index()
    {
        $roles = Rol::withCount(['permisos', 'usuarios'])->orderBy('etiqueta')->paginate(15);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permisos = Permiso::orderBy('grupo')->orderBy('etiqueta')->get()->groupBy('grupo');
        return view('roles.create', compact('permisos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:50|alpha_dash|unique:roles,nombre',
            'etiqueta' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:250',
            'permisos' => 'nullable|array',
            'permisos.*' => 'exists:permisos,id',
        ], [
            'nombre.required' => 'El nombre interno es obligatorio (ej. agente).',
            'nombre.alpha_dash' => 'El nombre interno solo admite letras, números, guiones y guiones bajos.',
            'nombre.unique' => 'Ya existe un rol con ese nombre interno.',
            'etiqueta.required' => 'El nombre visible es obligatorio.',
        ]);

        $rol = Rol::create($data);
        $rol->permisos()->sync($request->input('permisos', []));

        return redirect()->route('roles.index')
            ->with('success', 'Rol creado exitosamente.');
    }

    public function edit(Rol $rol)
    {
        $permisos = Permiso::orderBy('grupo')->orderBy('etiqueta')->get()->groupBy('grupo');
        return view('roles.edit', compact('rol', 'permisos'));
    }

    public function update(Request $request, Rol $rol)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:50', 'alpha_dash', Rule::unique('roles', 'nombre')->ignore($rol->id)],
            'etiqueta' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:250',
            'permisos' => 'nullable|array',
            'permisos.*' => 'exists:permisos,id',
        ], [
            'nombre.required' => 'El nombre interno es obligatorio (ej. agente).',
            'nombre.alpha_dash' => 'El nombre interno solo admite letras, números, guiones y guiones bajos.',
            'nombre.unique' => 'Ya existe un rol con ese nombre interno.',
            'etiqueta.required' => 'El nombre visible es obligatorio.',
        ]);

        // El nombre interno del rol administrador no se cambia.
        if ($rol->esProtegido()) {
            unset($data['nombre']);
        }

        $rol->update($data);
        $rol->permisos()->sync($request->input('permisos', []));

        return redirect()->route('roles.index')
            ->with('success', 'Rol actualizado exitosamente.');
    }

    public function destroy(Rol $rol)
    {
        if ($rol->esProtegido()) {
            return redirect()->route('roles.index')
                ->with('error', 'El rol administrador no se puede eliminar.');
        }

        $rol->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Rol eliminado exitosamente.');
    }
}
