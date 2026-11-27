@extends('layouts.dashboard')

@section('title', 'Editar Usuario - Sistema de Inmuebles')
@section('page-title', 'Editar Usuario')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white border-0">
                <h5 class="card-title mb-0">
                    <i class="fas fa-user-edit me-2"></i>
                    Editar: {{ $usuario->name }}
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('usuarios.update', $usuario) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name', $usuario->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo *</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Nueva contraseña</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar nueva contraseña</label>
                            <input type="password" class="form-control"
                                   id="password_confirmation" name="password_confirmation">
                            <small class="form-text text-muted">Déjala vacía para no cambiarla. Mínimo 6 caracteres.</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Roles</label>
                        @php $rolesUsuario = old('roles', $usuario->roles->pluck('id')->all()); @endphp
                        @foreach($roles as $rol)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="roles[]"
                                   id="rol-{{ $rol->id }}" value="{{ $rol->id }}"
                                   {{ in_array($rol->id, $rolesUsuario) ? 'checked' : '' }}>
                            <label class="form-check-label" for="rol-{{ $rol->id }}">
                                <strong>{{ $rol->etiqueta }}</strong>
                                @if($rol->descripcion)<span class="text-muted">— {{ $rol->descripcion }}</span>@endif
                            </label>
                        </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-custom">
                            <i class="fas fa-save me-2"></i>
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
