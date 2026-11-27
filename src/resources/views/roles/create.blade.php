@extends('layouts.dashboard')

@section('title', 'Nuevo Rol - Sistema de Inmuebles')
@section('page-title', 'Nuevo Rol')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white border-0">
                <h5 class="card-title mb-0">
                    <i class="fas fa-plus-circle me-2"></i>
                    Agregar Rol
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('roles.store') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre interno *</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                   id="nombre" name="nombre" value="{{ old('nombre') }}"
                                   placeholder="ej. agente" required>
                            @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="form-text text-muted">Solo letras, números, guiones y guiones bajos. Se usa en el código, no se muestra al público.</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="etiqueta" class="form-label">Nombre visible *</label>
                            <input type="text" class="form-control @error('etiqueta') is-invalid @enderror"
                                   id="etiqueta" name="etiqueta" value="{{ old('etiqueta') }}"
                                   placeholder="ej. Agente" required>
                            @error('etiqueta')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control @error('descripcion') is-invalid @enderror"
                               id="descripcion" name="descripcion" value="{{ old('descripcion') }}" maxlength="250">
                        @error('descripcion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Permisos</label>
                        @foreach($permisos as $grupo => $lista)
                        <h6 class="text-muted mt-3">{{ $grupo }}</h6>
                        @foreach($lista as $permiso)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permisos[]"
                                   id="permiso-{{ $permiso->id }}" value="{{ $permiso->id }}"
                                   {{ in_array($permiso->id, old('permisos', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="permiso-{{ $permiso->id }}">
                                {{ $permiso->etiqueta }}
                                <small class="text-muted">({{ $permiso->nombre }})</small>
                            </label>
                        </div>
                        @endforeach
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-custom">
                            <i class="fas fa-save me-2"></i>
                            Guardar Rol
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
