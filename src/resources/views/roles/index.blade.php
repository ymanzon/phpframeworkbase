@extends('layouts.dashboard')

@section('title', 'Roles - Sistema de Inmuebles')
@section('page-title', 'Roles y Permisos')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user-shield me-2"></i>
                        Lista de Roles
                    </h5>
                    @can('roles.crear')
                    <a href="{{ route('roles.create') }}" class="btn btn-custom">
                        <i class="fas fa-plus me-2"></i>
                        Nuevo Rol
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
                                <th>Rol</th>
                                <th>Descripción</th>
                                <th>Permisos</th>
                                <th>Usuarios</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $rol)
                            <tr>
                                <td>
                                    <strong>{{ $rol->etiqueta }}</strong>
                                    <br><small class="text-muted">{{ $rol->nombre }}</small>
                                </td>
                                <td>{{ $rol->descripcion ?? '—' }}</td>
                                <td>{{ $rol->permisos_count }}</td>
                                <td>{{ $rol->usuarios_count }}</td>
                                <td class="text-end">
                                    @can('roles.editar')
                                    <a href="{{ route('roles.edit', $rol) }}" class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('roles.eliminar')
                                    @unless($rol->esProtegido())
                                    <form method="POST" action="{{ route('roles.destroy', $rol) }}" class="d-inline" onsubmit="return confirm('¿Eliminar el rol {{ $rol->etiqueta }}? Los usuarios con ese rol quedarán sin él.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endunless
                                    @endcan
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No hay roles registrados.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $roles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
