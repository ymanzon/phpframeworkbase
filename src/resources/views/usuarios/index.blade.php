@extends('layouts.dashboard')

@section('title', 'Usuarios - Sistema de Inmuebles')
@section('page-title', 'Usuarios')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-users me-2"></i>
                        Lista de Usuarios
                    </h5>
                    @can('usuarios.crear')
                    <a href="{{ route('usuarios.create') }}" class="btn btn-custom">
                        <i class="fas fa-plus me-2"></i>
                        Nuevo Usuario
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Roles</th>
                                <th>Creado</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    @forelse($usuario->roles as $rol)
                                    <span class="badge bg-secondary me-1">{{ $rol->etiqueta }}</span>
                                    @empty
                                    <span class="text-muted">Sin rol</span>
                                    @endforelse
                                </td>
                                <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                                <td class="text-end">
                                    @can('usuarios.editar')
                                    <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('usuarios.eliminar')
                                    @if(auth()->id() !== $usuario->id)
                                    <form method="POST" action="{{ route('usuarios.destroy', $usuario) }}" class="d-inline" onsubmit="return confirm('¿Eliminar a {{ $usuario->name }}? Esta acción no se puede deshacer.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                    @endcan
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No hay usuarios registrados.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $usuarios->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
