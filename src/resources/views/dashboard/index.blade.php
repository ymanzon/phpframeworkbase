@extends('layouts.dashboard')

@section('title', 'Control de inmuebles - Sistema de Inmuebles')
@section('page-title', 'Control de Inmuebles')

@section('content')
<div class="row">
    <!-- Welcome Card -->
    <div class="col-12 mb-4">
        <div class="card stats-card">
            <div class="card-body text-center py-5">
                <h2 class="card-title mb-3" style="color: white;">
                    <i class="fas fa-tachometer-alt me-3"></i>
                    ¡Bienvenido al Panel de Control!
                </h2>
                <p class="card-text lead">
                    Gestiona todos tus inmuebles desde un solo lugar
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Total Inmuebles -->
    <div class="col-xl-3 col-md-6 mb-4" style="display:none">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Inmuebles
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalInmuebles }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-building stats-icon text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inmuebles Disponibles -->
    <div class="col-xl-3 col-md-6 mb-4" style="display: none;">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Disponibles
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $inmueblesDisponibles }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle stats-icon text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Para Renta -->
    <div class="col-xl-3 col-md-6 mb-4" style="display: none">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Para Renta
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $inmueblesRenta }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-key stats-icon text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Para Venta -->
    <div class="col-xl-3 col-md-6 mb-4" style="display: none;">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Para Venta
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $inmueblesVenta }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign stats-icon text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Quick Actions -->
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header bg-white border-0">
                <h5 class="card-title mb-0">
                    <i class="fas fa-bolt me-2"></i>
                    Acciones Rápidas
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('inmuebles.create') }}" class="btn btn-custom w-100 py-3">
                            <i class="fas fa-plus-circle me-2"></i>
                            Agregar Nuevo Inmueble
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('inmuebles.index') }}" class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-list me-2"></i>
                            Ver Todos los Inmuebles
                        </a>
                    </div>
                </div>
                
                <hr class="my-4">
                
                <div class="row text-center">
                    <div class="col-md-4 mb-3">
                        <div class="p-3">
                            <i class="fas fa-camera fa-2x text-primary mb-2"></i>
                            <h6>Gestión de Fotos</h6>
                            <p class="text-muted small">Hasta 4 fotos por inmueble</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="p-3">
                            <i class="fas fa-map-marker-alt fa-2x text-success mb-2"></i>
                            <h6>Ubicaciones</h6>
                            <p class="text-muted small">Mérida y otras ciudades</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="p-3">
                            <i class="fas fa-toggle-on fa-2x text-warning mb-2"></i>
                            <h6>Control de Estado</h6>
                            <p class="text-muted small">Disponible/No disponible</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- System Info -->
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header bg-white border-0">
                <h5 class="card-title mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Información del Sistema
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Usuario actual</small>
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted">Email</small>
                    <div class="fw-bold">{{ Auth::user()->email }}</div>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted">Último acceso</small>
                    <div class="fw-bold">{{ now()->format('d/m/Y H:i') }}</div>
                </div>
                
                <hr class="my-3">
                
                <div class="text-center">
                    <h6 class="text-muted">Estado del Sistema</h6>
                    <span class="badge bg-success fs-6">
                        <i class="fas fa-check-circle me-1"></i>
                        Operativo
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity (placeholder for future functionality) -->
<div class="row" style="display: none;">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white border-0">
                <h5 class="card-title mb-0">
                    <i class="fas fa-clock me-2"></i>
                    Actividad Reciente
                </h5>
            </div>
            <div class="card-body text-center py-5">
                <i class="fas fa-history fa-3x text-muted mb-3"></i>
                <h6 class="text-muted">No hay actividad reciente</h6>
                <p class="text-muted">Las acciones realizadas aparecerán aquí</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .stats-icon {
        opacity: 0.8;
    }
    
    .text-xs {
        font-size: 0.7rem;
    }
    
    .card-title {
        color: #495057;
        font-weight: 600;
    }
    
    .btn-outline-primary {
        border-color: #667eea;
        color: #667eea;
        transition: all 0.3s ease;
    }
    
    .btn-outline-primary:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-color: #667eea;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    
    .badge {
        padding: 0.5rem 1rem;
    }
    
    @media (max-width: 768px) {
        .stats-icon {
            font-size: 2rem !important;
        }
        
        .h5 {
            font-size: 1.1rem;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    // Animaciones de entrada
    $(document).ready(function() {
        $('.card').each(function(index) {
            $(this).hide().delay(index * 100).fadeIn(500);
        });
        
        // Actualizar hora cada minuto
        setInterval(function() {
            const now = new Date();
            const timeString = now.toLocaleString('es-ES', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
            // Aquí podrías actualizar la hora si fuera necesario
        }, 60000);
    });
</script>
@endsection