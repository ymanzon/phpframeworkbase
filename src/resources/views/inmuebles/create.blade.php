@extends('layouts.dashboard')

@section('title', 'Crear Inmueble - Sistema de Inmuebles')
@section('page-title', 'Crear Nuevo Inmueble')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-plus-circle me-2"></i>
                        Agregar Inmueble
                    </h5>
                    <a href="{{ route('inmuebles.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>
                        Volver
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('inmuebles.store') }}" enctype="multipart/form-data">
                    @csrf

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
                                    value="{{ old('nombre') }}"
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
                                    required>{{ old('descripcion') }}</textarea>
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
                                            value="{{ old('precio') }}"
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
                                        <option value="Renta" {{ old('tipo') == 'Renta' ? 'selected' : '' }}>Renta</option>
                                        <option value="Venta" {{ old('tipo') == 'Venta' ? 'selected' : '' }}>Venta</option>
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
                                        value="{{ old('numero_cuartos') }}"
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
                                        value="{{ old('numero_banos') }}"
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
                                        value="{{ old('numero_pisos') }}"
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
                                        value="{{ old('tamano_construccion') }}"
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
                                        value="{{ old('tamano_terreno') }}"
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
                                    <option value="Merida" {{ old('ciudad') == 'Merida' ? 'selected' : '' }}>Mérida</option>
                                    <option value="Monterrey" {{ old('ciudad') == 'Monterrey' ? 'selected' : '' }}>Monterrey</option>
                                    <option value="Campeche" {{ old('ciudad') == 'Campeche' ? 'selected' : '' }}>Campeche</option>
                                    <option value="Progreso" {{ old('ciudad') == 'Progreso' ? 'selected' : '' }}>Progreso</option>
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
                                        value="{{ old('disponibilidad', true) ? '1' : '0' }}"
                                        {{ old('disponibilidad', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="disponibilidad">
                                        Disponible
                                    </label>
                                </div>
                            </div>

                            <!-- Fotos -->
                            <h6 class="text-muted mb-3 mt-4">
                                <i class="fas fa-camera me-2"></i>
                                Fotos (máximo 10)
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

                            <!-- Preview de fotos -->
                            <div id="imagePreview" class="row g-2"></div>
                        </div>
                    </div>



                    <!-- Submit Buttons -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <hr>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('inmuebles.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i>
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-custom">
                                    <i class="fas fa-save me-2"></i>
                                    Guardar Inmueble
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

    .form-control:focus,
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .preview-image {
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
        preview.innerHTML = '';

        if (input.files) {

            input.files = validarFileSize(input);

            const files = Array.from(input.files).slice(0, 10);

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

            /*//validar tamaño de archivo
                if (file.size > 2 * 1024 * 1024) { // 2MB
                    alert('El archivo ' + file.name + ' es demasiado grande. Máximo 2MB.');
                } else { */



            // Actualizar el input para que solo contenga los primeros 4 archivos
            if (input.files.length > 10) {
                const dt = new DataTransfer();
                files.forEach(file => dt.items.add(file));
                input.files = dt.files;

                // Mostrar alerta
                alert('Solo se pueden subir máximo 4 imágenes. Se han seleccionado las primeras 10.');
            }

           

        }
    }

    function removePreviewImage(button, index) {
        const input = document.getElementById('fotos');
        const dt = new DataTransfer();

        // Recrear la lista de archivos sin el archivo eliminado
        Array.from(input.files).forEach((file, i) => {
            if (i !== index) {
                dt.items.add(file);
            }
        });

        input.files = dt.files;

        // Actualizar preview
        previewImages(input);
    }

    // Validación del formulario
    $(document).ready(function() {
        $('form').on('submit', function(e) {
            let valid = true;

            // Validar campos requeridos
            $('[required]').each(function() {
                if (!$(this).val()) {
                    valid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            // Validar precio
            const precio = parseFloat($('#precio').val());
            if (precio < 0) {
                valid = false;
                $('#precio').addClass('is-invalid');
                alert('El precio no puede ser negativo.');
            }

            // Validar números enteros positivos
            const numeroBanos = parseInt($('#numero_banos').val());
            const numeroPisos = parseInt($('#numero_pisos').val());

            if (numeroBanos < 1 || numeroPisos < 1) {
                valid = false;
                alert('El número de baños y pisos debe ser mayor a 0.');
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

        // Formato de precio en tiempo real
        $('#precio').on('input', function() {
            let value = $(this).val();
            if (value) {
                // Remover formato anterior
                value = value.replace(/,/g, '');

                // Aplicar formato con comas
                if (!isNaN(value)) {
                    const formatted = parseFloat(value).toLocaleString('en-US');
                    // No aplicar formato mientras el usuario está escribiendo
                }
            }
        });
    });
</script>
@endsection