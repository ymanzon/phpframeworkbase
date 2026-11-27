@extends('layouts.dashboard')

@section('title', 'Leads - Sistema de Inmuebles')
@section('page-title', 'Leads')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white border-0">
                <h5 class="card-title mb-0">
                    <i class="fas fa-inbox me-2"></i>
                    Bandeja de Leads
                </h5>
                <small class="text-muted">Mensajes del formulario de contacto y de las fichas de propiedad. Los avisos llegan por {{ implode(' y ', config('inmobiliaria.leads.canales', ['correo'])) }}.</small>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Nombre</th>
                                <th>Contacto</th>
                                <th>Propiedad</th>
                                <th>Mensaje</th>
                                <th>Estado</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($leads as $lead)
                            <tr>
                                <td>{{ $lead->created_at->format('d/m/Y H:i') }}</td>
                                <td><strong>{{ $lead->nombre }}</strong></td>
                                <td>
                                    {{ $lead->correo }}
                                    @if($lead->telefono)<br><small class="text-muted">{{ $lead->telefono }}</small>@endif
                                </td>
                                <td>{{ $lead->inmueble ? $lead->inmueble->nombre : '—' }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($lead->mensaje, 80) }}</td>
                                <td>
                                    @if($lead->leido)
                                    <span class="badge bg-success">Leído</span>
                                    @else
                                    <span class="badge bg-warning text-dark">Nuevo</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    @unless($lead->leido)
                                    <form method="POST" action="{{ route('leads.marcar-leido', $lead) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-outline-success btn-sm" title="Marcar como leído">
                                            <i class="fas fa-check"></i> Leído
                                        </button>
                                    </form>
                                    @endunless
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Aún no hay leads. Cuando alguien llene el formulario de contacto, aparecerá aquí.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $leads->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
