@extends('layouts.dashboard')

@section('title', 'Editar Inmueble - Sistema de Inmuebles')
@section('page-title', 'Editar Inmueble')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Editar: {{ $inmueble->nombre }}
                    </h5>
                    <div class="btn-group">
                        <a href="{{ route('inmuebles.show', $inmueble) }}" class="btn btn-outline-info btn-sm">
                            <i class="fas fa-eye me-1"></i>
                            Ver
                        </a>
                        <a href="{{ route('inmuebles.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>
                            Volver
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('inmuebles.update', $inmueble) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Basic Information -->
                        <div class="col-lg-8">
                            <h6 class="text-muted mb-3">
                                <i class="fas fa-info-circle me-2"></i>
                                Información Básica
                            </h6>
                            
                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Inmueble *</label>
                                <input type="text" 
                                       class="form-control @error('nombre') is-invalid @enderror" 
                                       id="nombre" 
                                       name="nombre" 
                                       value="{{ old('nombre', $inmueble->nombre) }}" 
                                       maxlength="250"
                                       required>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Descripción -->
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción *</label>
                                <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                          id="descripcion" 
                                          name="descripcion" 
                                          rows="4" 
                                          required>{{ old('descripcion', $inmueble->descripcion) }}</textarea>
                                @error('descripcion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Precio y Tipo -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="precio" class="form-label">Precio *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" 
                                               class="form-control @error('precio') is-invalid @enderror" 
                                               id="precio" 
                                               name="precio" 
                                               value="{{ old('precio', $inmueble->precio) }}" 
                                               step="0.01" 
                                               min="0" 
                                               required>
                                    </div>
                                    @error('precio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tipo" class="form-label">Tipo *</label>
                                    <select class="form-select @error('tipo') is-invalid @enderror" 
                                            id="tipo" 
                                            name="tipo" 
                                            required>
                                        <option value="">Seleccionar tipo</option>
                                        <option value="Renta" {{ old('tipo', $inmueble->tipo) == 'Renta' ? 'selected' : '' }}>Renta</option>
                                        <option value="Venta" {{ old('tipo', $inmueble->tipo) == 'Venta' ? 'selected' : '' }}>Venta</option>
                                    </select>
                                    @error('tipo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Características -->
                            <h6 class="text-muted mb-3 mt-4">
                                <i class="fas fa-home me-2"></i>
                                Características
                            </h6>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="numero_cuartos" class="form-label">Número de Cuartos *</label>
                                    <input type="number" 
                                           class="form-control @error('numero_cuartos') is-invalid @enderror" 
                                           id="numero_cuartos" 
                                           name="numero_cuartos" 
                                           value="{{ old('numero_cuartos', $inmueble->numero_cuartos) }}" 
                                           min="1" 
                                           required>
                                    @error('numero_cuartos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="numero_banos" class="form-label">Número de Baños *</label>
                                    <input type="number" 
                                           class="form-control @error('numero_banos') is-invalid @enderror" 
                                           id="numero_banos" 
                                           name="numero_banos" 
                                           value="{{ old('numero_banos', $inmueble->numero_banos) }}" 
                                           step="0.5"
                                           min="0"
                                           required>
                                    @error('numero_banos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="numero_pisos" class="form-label">Número de Pisos *</label>
                                    <input type="number" 
                                           class="form-control @error('numero_pisos') is-invalid @enderror" 
                                           id="numero_pisos" 
                                           name="numero_pisos" 
                                           value="{{ old('numero_pisos', $inmueble->numero_pisos) }}" 
                                           min="1" 
                                           required>
                                    @error('numero_pisos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tamano_construccion" class="form-label">Tamaño de Construcción (m²) *</label>
                                    <input type="number" 
                                           class="form-control @error('tamano_construccion') is-invalid @enderror" 
                                           id="tamano_construccion" 
                                           name="tamano_construccion" 
                                           value="{{ old('tamano_construccion', $inmueble->tamano_construccion) }}" 
                                           step="0.01" 
                                           min="0" 
                                           required>
                                    @error('tamano_construccion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tamano_terreno" class="form-label">Tamaño del Terreno (m²) *</label>
                                    <input type="number" 
                                           class="form-control @error('tamano_terreno') is-invalid @enderror" 
                                           id="tamano_terreno" 
                                           name="tamano_terreno" 
                                           value="{{ old('tamano_terreno', $inmueble->tamano_terreno) }}" 
                                           step="0.01" 
                                           min="0" 
                                           required>
                                    @error('tamano_terreno')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="col-lg-4">
                            <h6 class="text-muted mb-3">
                                <i class="fas fa-cog me-2"></i>
                                Configuración
                            </h6>

                            <!-- Ciudad -->
                            <div class="mb-3">
                                <label for="ciudad" class="form-label">Ciudad *</label>
                                <select class="form-select @error('ciudad') is-invalid @enderror" 
                                        id="ciudad" 
                                        name="ciudad" 
                                        required>
                                    <option value="">Seleccionar ciudad</option>
                                    <option value="Merida" {{ old('ciudad', $inmueble->ciudad) == 'Merida' ? 'selected' : '' }}>Mérida</option>
                                    <option value="Monterrey" {{ old('ciudad', $inmueble->ciudad) == 'Monterrey' ? 'selected' : '' }}>Monterrey</option>
                                    <option value="Campeche" {{ old('ciudad', $inmueble->ciudad) == 'Campeche' ? 'selected' : '' }}>Campeche</option>
                                    <option value="Progreso" {{ old('ciudad', $inmueble->ciudad) == 'Progreso' ? 'selected' : '' }}>Progreso</option>
                                </select>
                                @error('ciudad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Disponibilidad -->
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           id="disponibilidad" 
                                           name="disponibilidad" 
                                           value="{{ old('disponibilidad', $inmueble->disponibilidad) ? '1' : '0' }}"
                                           {{ old('disponibilidad', $inmueble->disponibilidad) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="disponibilidad">
                                        Disponible
                                    </label>
                                </div>
                            </div>

                            <!-- Fotos Existentes -->
                            @if($inmueble->fotos && count($inmueble->fotos) > 0)
                                <h6 class="text-muted mb-3 mt-4">
                                    <i class="fas fa-images me-2"></i>
                                    Fotos Actuales
                                </h6>
                                <div class="row g-2 mb-3" id="existingPhotos">
                                    @foreach($inmueble->fotos as $index => $foto)
                                        <div class="col-6 existing-photo" data-index="{{ $index }}">
                                            <div class="position-relative">
                                                <img src="{{ asset('storage/' . $foto) }}" 
                                                     class="img-thumbnail w-100" 
                                                     style="height: 80px; object-fit: cover;" 
                                                     alt="Foto {{ $index + 1 }}">
                                                <button type="button" 
                                                        class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                                        style="font-size: 10px; padding: 2px 6px;"
                                                        onclick="deleteExistingPhoto({{ $inmueble->id }}, {{ $index }}, this)">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Nuevas Fotos -->
                            <h6 class="text-muted mb-3 mt-4">
                                <i class="fas fa-camera me-2"></i>
                                Agregar Fotos
                            </h6>

                            <div class="mb-3">
                                <input type="file" 
                                       class="form-control @error('fotos') is-invalid @enderror" 
                                       id="fotos" 
                                       name="fotos[]" 
                                       multiple 
                                       accept="image/*"
                                       onchange="previewImages(this)">
                                <small class="form-text text-muted">
                                    Formatos: JPG, PNG, GIF. Máximo 2MB por imagen.
                                    <br>Total máximo: 10 fotos.
                                </small>
                                @error('fotos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if ($errors->has('fotos.*'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('fotos.*') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Preview de nuevas fotos -->
                            <div id="imagePreview" class="row g-2"></div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <hr>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('inmuebles.show', $inmueble) }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i>
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-custom">
                                    <i class="fas fa-save me-2"></i>
                                    Actualizar Inmueble
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .form-label {
        font-weight: 600;
        color: #495057;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .preview-image, .existing-photo {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
    }
    
    .preview-image img {
        width: 100%;
        height: 80px;
        object-fit: cover;
    }
    
    .remove-image {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(220, 53, 69, 0.8);
        color: white;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        font-size: 12px;
        cursor: pointer;
    }
    
    .card-header {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    }
    
    .img-thumbnail {
        border: 2px solid #dee2e6;
        transition: all 0.3s ease;
    }
    
    .img-thumbnail:hover {
        border-color: #667eea;
        transform: scale(1.05);
    }
</style>
@endsection

@section('scripts')
<script>
    function validarFileSize(input){
        //const files = Array.from(input.files).slice(0, 10);
        let files = Array.from(input.files).slice(0, 10);
        const dt = new DataTransfer();
            //vlidar tamaño de archivo
            files.forEach((file) => {
                if (file.size > 2 * 1024 * 1024) { // 2MB
                    alert('El archivo ' + file.name + ' es demasiado grande. Máximo 2MB.');
                } else {
                    //se agrega a una lista de archivos para validarlos luego
                    dt.items.add(file);
                }
            });

            return  dt.files;
    }

    function previewImages(input) {
        const preview = document.getElementById('imagePreview');
        const existingPhotos = document.querySelectorAll('.existing-photo').length;
        const maxPhotos = 10;
        const availableSlots = maxPhotos - existingPhotos;
        
        preview.innerHTML = '';
        
        if (input.files) {
            //valido si tienen el tamaño correcto
             input.files = validarFileSize(input);
            // Limitar archivos según slots disponibles
            const files = Array.from(input.files).slice(0, availableSlots);
            
            files.forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.className = 'col-6 mb-2';
                        
                        col.innerHTML = `
                            <div class="preview-image">
                                <img src="${e.target.result}" alt="Preview ${index + 1}">
                                <button type="button" class="remove-image" onclick="removePreviewImage(this, ${index})">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        `;
                        
                        preview.appendChild(col);
                    };
                    
                    reader.readAsDataURL(file);
                }
            });
            
            // Actualizar el input
            if (input.files.length > availableSlots) {
                const dt = new DataTransfer();
                files.forEach(file => dt.items.add(file));
                input.files = dt.files;
                
                alert(`Solo puedes agregar ${availableSlots} fotos más. Total máximo: 10 fotos.`);
            }
        }
    }
    
    function removePreviewImage(button, index) {
        const input = document.getElementById('fotos');
        const dt = new DataTransfer();
        
        Array.from(input.files).forEach((file, i) => {
            if (i !== index) {
                dt.items.add(file);
            }
        });
        
        input.files = dt.files;
        previewImages(input);
    }
    
    function deleteExistingPhoto(inmuebleId, index, button) {
        if (confirm('¿Estás seguro de eliminar esta foto?')) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                url: `/inmuebles/${inmuebleId}/foto/${index}`,
                type: 'DELETE',
                success: function(response) {
                    if (response.success) {
                        $(button).closest('.existing-photo').fadeOut(300, function() {
                            $(this).remove();
                        });
                    } else {
                        alert('Error al eliminar la foto');
                    }
                },
                error: function() {
                    alert('Error al eliminar la foto');
                }
            });
        }
    }
    
    // Validación del formulario
    $(document).ready(function() {
        $('form').on('submit', function(e) {
            let valid = true;
            
            $('[required]').each(function() {
                if (!$(this).val()) {
                    valid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            
            const precio = parseFloat($('#precio').val());
            if (precio < 0) {
                valid = false;
                $('#precio').addClass('is-invalid');
                alert('El precio no puede ser negativo.');
            }
            
            if (!valid) {
                e.preventDefault();
                return false;
            }
        });
        
        // Auto-resize textarea
        $('#descripcion').on('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    });
</script>
@endsection