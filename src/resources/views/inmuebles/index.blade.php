@extends('layouts.dashboard')

@section('title', 'Inmuebles - Sistema de Inmuebles')
@section('page-title', 'Gestión de Inmuebles')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h4 class="text-muted">
            <i class="fas fa-building me-2"></i>
            Lista de Inmuebles
        </h4>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('inmuebles.create') }}" class="btn btn-custom">
            <i class="fas fa-plus me-2"></i>
            Agregar Inmueble
        </a>
    </div>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('inmuebles.index') }}">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Tipo</label>
                    <select name="tipo" class="form-select">
                        <option value="">Todos</option>
                        <option value="Renta" {{ request('tipo') == 'Renta' ? 'selected' : '' }}>Renta</option>
                        <option value="Venta" {{ request('tipo') == 'Venta' ? 'selected' : '' }}>Venta</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Ciudad</label>
                    <select name="ciudad" class="form-select">
                        <option value="">Todas</option>
                        <option value="Merida" {{ request('ciudad') == 'Merida' ? 'selected' : '' }}>Mérida</option>
                        <option value="Monterrey" {{ request('ciudad') == 'Monterrey' ? 'selected' : '' }}>Monterrey</option>
                        <option value="Campeche" {{ request('ciudad') == 'Campeche' ? 'selected' : '' }}>Campeche</option>
                        <option value="Progreso" {{ request('ciudad') == 'Progreso' ? 'selected' : '' }}>Progreso</option>  
                    
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Disponibilidad</label>
                    <select name="disponibilidad" class="form-select">
                        <option value="">Todos</option>
                        <option value="1" {{ request('disponibilidad') == '1' ? 'selected' : '' }}>Disponible</option>
                        <option value="0" {{ request('disponibilidad') == '0' ? 'selected' : '' }}>No Disponible</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-outline-primary me-2">
                        <i class="fas fa-search"></i> Filtrar
                    </button>
                    <a href="{{ route('inmuebles.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i> Limpiar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Inmuebles Grid -->
@if($inmuebles->count() > 0)
    <div class="row">
        @foreach($inmuebles as $inmueble)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 property-card">
                    <!-- Image -->
                    <div class="card-img-top-container" style="height: 200px; overflow: hidden;">
                        @if($inmueble->fotos && count($inmueble->fotos) > 0)
                            <img src="{{ asset('storage/' . $inmueble->fotos[0]) }}" 
                                 class="card-img-top" 
                                 style="height: 100%; object-fit: cover;"
                                 alt="{{ $inmueble->nombre }}">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center h-100">
                                <i class="fas fa-image fa-3x text-muted"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Card Body -->
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title text-truncate flex-grow-1">{{ $inmueble->nombre }}</h5>
                            <span class="badge {{ $inmueble->disponibilidad ? 'bg-success' : 'bg-danger' }} ms-2">
                                {{ $inmueble->disponibilidad ? 'Disponible' : 'No Disponible' }}
                            </span>
                        </div>

                        <div class="mb-2">
                            <span class="badge bg-primary">{{ $inmueble->tipo }}</span>
                            <span class="badge bg-info">{{ $inmueble->ciudad }}</span>
                        </div>

                        <p class="card-text text-muted small mb-2">
                            {{ Str::limit($inmueble->descripcion, 100) }}
                        </p>

                        <!-- Property Details -->
                        <div class="row text-center mb-3">
                            <div class="col-3">
                                <i class="fas fa-bed text-primary"></i>
                                <small class="d-block">{{ $inmueble->numero_cuartos }} cuartos</small>
                            </div>
                            <div class="col-3">
                                <i class="fas fa-bath text-primary"></i>
                                <small class="d-block">{{ $inmueble->numero_banos }} baños</small>
                            </div>
                            <div class="col-3">
                                <i class="fas fa-layer-group text-success"></i>
                                <small class="d-block">{{ $inmueble->numero_pisos }} pisos</small>
                            </div>
                            <div class="col-3">
                                <i class="fas fa-ruler-combined text-warning"></i>
                                <small class="d-block">{{ $inmueble->tamano_construccion }}m²</small>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="text-center mb-3">
                            <h4 class="text-primary mb-0">{{ $inmueble->precio_formateado }}</h4>
                        </div>

                        <!-- Actions -->
                        <div class="mt-auto">
                            <div class="btn-group w-100" role="group">
                                <a href="{{ route('inmuebles.show', $inmueble) }}" 
                                   class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('inmuebles.edit', $inmueble) }}" 
                                   class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" 
                                        class="btn btn-outline-danger btn-sm"
                                        onclick="confirmDelete({{ $inmueble->id }}, '{{ $inmueble->nombre }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $inmuebles->links() }}
    </div>
@else
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="fas fa-home fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">No hay inmuebles registrados</h5>
            <p class="text-muted">Comienza agregando tu primer inmueble</p>
            <a href="{{ route('inmuebles.create') }}" class="btn btn-custom">
                <i class="fas fa-plus me-2"></i>
                Agregar Inmueble
            </a>
        </div>
    </div>
@endif

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que quieres eliminar el inmueble <strong id="propertyName"></strong>?</p>
                <p class="text-muted">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .property-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .property-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    }
    
    .badge {
        font-size: 0.7em;
    }
    
    .btn-group .btn {
        flex: 1;
    }
    
    .card-img-top-container {
        position: relative;
        overflow: hidden;
        border-radius: 15px 15px 0 0;
    }
    
    .card-img-top {
        transition: transform 0.3s ease;
    }
    
    .property-card:hover .card-img-top {
        transform: scale(1.05);
    }
</style>
@endsection

@section('scripts')
<script>
    function confirmDelete(id, name) {
        document.getElementById('propertyName').textContent = name;
        document.getElementById('deleteForm').action = '/inmuebles/' + id;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
</script>
@endsection