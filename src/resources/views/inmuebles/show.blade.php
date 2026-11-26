@extends('layouts.dashboard')

@section('title', 'Ver Inmueble - Sistema de Inmuebles')
@section('page-title', 'Detalles del Inmueble')

@section('content')
<div class="row">
    <!-- Header -->
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header bg-white border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">{{ $inmueble->nombre }}</h4>
                        <div class="mt-2">
                            <span class="badge {{ $inmueble->disponibilidad ? 'bg-success' : 'bg-danger' }} me-2">
                                {{ $inmueble->disponibilidad ? 'Disponible' : 'No Disponible' }}
                            </span>
                            <span class="badge bg-primary me-2">{{ $inmueble->tipo }}</span>
                            <span class="badge bg-info">{{ $inmueble->ciudad }}</span>
                        </div>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('inmuebles.edit', $inmueble) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>
                            Editar
                        </a>
                        <a href="{{ route('inmuebles.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Galería de Fotos -->
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header bg-white border-0">
                <h5 class="card-title mb-0">
                    <i class="fas fa-images me-2"></i>
                    Galería de Fotos
                </h5>
            </div>
            <div class="card-body">
                @if($inmueble->fotos && count($inmueble->fotos) > 0)
                    <!-- Foto principal -->
                    <div class="mb-3">
                        <img id="mainImage" 
                             src="{{ asset('storage/' . $inmueble->fotos[0]) }}" 
                             class="img-fluid rounded shadow-sm"
                             style="width: 100%; height: 400px; object-fit: cover;"
                             alt="{{ $inmueble->nombre }}">
                    </div>
                    
                    <!-- Thumbnails -->
                    @if(count($inmueble->fotos) > 1)
                        <div class="row g-2">
                            @foreach($inmueble->fotos as $index => $foto)
                                <div class="col-3">
                                    <img src="{{ asset('storage/' . $foto) }}" 
                                         class="img-thumbnail thumbnail-photo {{ $index === 0 ? 'active' : '' }}"
                                         style="height: 80px; object-fit: cover; cursor: pointer;"
                                         onclick="changeMainImage('{{ asset('storage/' . $foto) }}', this)"
                                         alt="Foto {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-image fa-3x text-muted mb-3"></i>
                        <h6 class="text-muted">No hay fotos disponibles</h6>
                        <a href="{{ route('inmuebles.edit', $inmueble) }}" class="btn btn-outline-primary">
                            <i class="fas fa-plus me-2"></i>
                            Agregar Fotos
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Descripción -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white border-0">
                <h5 class="card-title mb-0">
                    <i class="fas fa-align-left me-2"></i>
                    Descripción
                </h5>
            </div>
            <div class="card-body">
                <p class="mb-0" style="white-space: pre-line; line-height: 1.6;">{{ $inmueble->descripcion }}</p>
            </div>
        </div>
    </div>
</div>
    </div>

    <!-- Información del Inmueble -->
    <div class="col-lg-4">
        <!-- Precio -->
        <div class="card mb-4">
            <div class="card-body text-center">
                <h2 class="text-primary mb-0">{{ $inmueble->precio_formateado }}</h2>
                <small class="text-muted">Precio para {{ $inmueble->tipo }}</small>
            </div>
        </div>

        <!-- Características -->
        <div class="card mb-4">
            <div class="card-header bg-white border-0">
                <h6 class="card-title mb-0">
                    <i class="fas fa-home me-2"></i>
                    Características
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="border-end">
                            <i class="fas fa-bed fa-2x text-primary mb-2"></i>
                            <div class="fw-bold">{{ $inmueble->numero_cuartos }}</div>
                            <small class="text-muted">Cuartos</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="border-end">
                            <i class="fas fa-bath fa-2x text-primary mb-2"></i>
                            <div class="fw-bold">{{ $inmueble->numero_banos }}</div>
                            <small class="text-muted">Baños</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <i class="fas fa-layer-group fa-2x text-success mb-2"></i>
                        <div class="fw-bold">{{ $inmueble->numero_pisos }}</div>
                        <small class="text-muted">Pisos</small>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="border-end">
                            <i class="fas fa-ruler-combined fa-2x text-warning mb-2"></i>
                            <div class="fw-bold">{{ $inmueble->tamano_construccion }}m²</div>
                            <small class="text-muted">Construcción</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <i class="fas fa-expand-arrows-alt fa-2x text-info mb-2"></i>
                        <div class="fw-bold">{{ $inmueble->tamano_terreno }}m²</div>
                        <small class="text-muted">Terreno</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ubicación -->
        <div class="card mb-4">
            <div class="card-header bg-white border-0">
                <h6 class="card-title mb-0">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    Ubicación
                </h6>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <i class="fas fa-city fa-2x text-primary me-3"></i>
                    <div>
                        <div class="fw-bold">{{ $inmueble->ciudad }}</div>
                        <small class="text-muted">Ciudad</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estado -->
        <div class="card mb-4">
            <div class="card-header bg-white border-0">
                <h6 class="card-title mb-0">
                    <i class="fas fa-toggle-on me-2"></i>
                    Estado
                </h6>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <span>Disponibilidad:</span>
                    <span class="badge {{ $inmueble->disponibilidad ? 'bg-success' : 'bg-danger' }} fs-6">
                        <i class="fas {{ $inmueble->disponibilidad ? 'fa-check' : 'fa-times' }} me-1"></i>
                        {{ $inmueble->disponibilidad ? 'Disponible' : 'No Disponible' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Acciones -->
        <div class="card">
            <div class="card-header bg-white border-0">
                <h6 class="card-title mb-0">
                    <i class="fas fa-cogs me-2"></i>
                    Acciones
                </h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('inmuebles.edit', $inmueble) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>
                        Editar Inmueble
                    </a>
                    <button type="button" 
                            class="btn btn-danger"
                            onclick="confirmDelete({{ $inmueble->id }}, '{{ $inmueble->nombre }}')">
                        <i class="fas fa-trash me-2"></i>
                        Eliminar Inmueble
                    </button>
                    <a href="{{ route('inmuebles.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-list me-2"></i>
                        Ver Todos
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Información Adicional -->
<div class="row mt-4" style="display: none;">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white border-0">
                <h6 class="card-title mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Información del Sistema
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td class="text-muted">ID:</td>
                        <td class="fw-bold">#{{ $inmueble->id }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Creado:</td>
                        <td>{{ $inmueble->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Actualizado:</td>
                        <td>{{ $inmueble->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Fotos:</td>
                        <td>{{ $inmueble->fotos ? count($inmueble->fotos) : 0 }}/4</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white border-0">
                <h6 class="card-title mb-0">
                    <i class="fas fa-calculator me-2"></i>
                    Métricas
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td class="text-muted">Precio por m² (construcción):</td>
                        <td class="fw-bold">${{ number_format($inmueble->precio / $inmueble->tamano_construccion, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Precio por m² (terreno):</td>
                        <td class="fw-bold">${{ number_format($inmueble->precio / $inmueble->tamano_terreno, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Ratio construcción/terreno:</td>
                        <td>{{ number_format(($inmueble->tamano_construccion / $inmueble->tamano_terreno) * 100, 1) }}%</td>
                    </tr>
                    <tr>
                        <td class="text-muted">m² por piso:</td>
                        <td>{{ number_format($inmueble->tamano_construccion / $inmueble->numero_pisos, 1) }}m²</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                </div>
                <p class="text-center">¿Estás seguro de que quieres eliminar el inmueble <strong id="propertyName"></strong>?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-info-circle me-2"></i>
                    Esta acción eliminará permanentemente:
                    <ul class="mb-0 mt-2">
                        <li>Toda la información del inmueble</li>
                        <li>Todas las fotos asociadas</li>
                        <li>No se puede deshacer</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Eliminar Permanentemente
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $inmueble->nombre }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <img id="modalImage" src="" class="img-fluid w-100" alt="">
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .thumbnail-photo {
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .thumbnail-photo:hover, .thumbnail-photo.active {
        border-color: #667eea;
        transform: scale(1.05);
    }
    
    .card {
        transition: transform 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    #mainImage {
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    
    #mainImage:hover {
        transform: scale(1.02);
    }
    
    .badge {
        font-size: 0.8em;
    }
    
    .table td {
        padding: 0.5rem 0;
    }
    
    .border-end {
        border-right: 1px solid #dee2e6 !important;
    }
    
    @media (max-width: 768px) {
        .border-end {
            border-right: none !important;
            border-bottom: 1px solid #dee2e6 !important;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    function changeMainImage(src, thumbnail) {
        document.getElementById('mainImage').src = src;
        
        // Remover clase active de todos los thumbnails
        document.querySelectorAll('.thumbnail-photo').forEach(thumb => {
            thumb.classList.remove('active');
        });
        
        // Agregar clase active al thumbnail seleccionado
        thumbnail.classList.add('active');
    }
    
    function confirmDelete(id, name) {
        document.getElementById('propertyName').textContent = name;
        document.getElementById('deleteForm').action = '/inmuebles/' + id;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
    
    // Abrir imagen en modal al hacer clic
    $(document).ready(function() {
        $('#mainImage').on('click', function() {
            const src = $(this).attr('src');
            $('#modalImage').attr('src', src);
            new bootstrap.Modal(document.getElementById('imageModal')).show();
        });
        
        // Animaciones de entrada
        $('.card').each(function(index) {
            $(this).hide().delay(index * 100).fadeIn(500);
        });
        
        // Tooltips para los iconos
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
</script>
@endsection