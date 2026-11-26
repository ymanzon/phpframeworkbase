{{-- Selector de ubicación con mapa (Leaflet + OpenStreetMap, sin llave de API).
     Recibe $latitud, $longitud y $direccion (old() en crear, $inmueble en editar).
     El JavaScript está en public/js/mapa-ubicacion.js; los valores iniciales y el
     centro del mapa llegan por los data-* del div #mapaUbicacion. --}}
<div class="mb-3">
    <label class="form-label">Ubicación del inmueble</label>
    <div class="input-group mb-2">
        <input type="text" id="buscarDireccion" class="form-control" placeholder="Buscar calle, colonia o referencia...">
        <button type="button" class="btn btn-outline-secondary" id="btnBuscarDireccion">
            <i class="fas fa-search"></i> Buscar
        </button>
        <button type="button" class="btn btn-outline-secondary" id="btnMiUbicacion" title="Usar mi ubicación actual">
            <i class="fas fa-location-arrow"></i>
        </button>
    </div>
    <div id="mapaUbicacion"
         data-latitud="{{ $latitud }}"
         data-longitud="{{ $longitud }}"
         data-centro-latitud="{{ config('inmobiliaria.mapa.latitud') }}"
         data-centro-longitud="{{ config('inmobiliaria.mapa.longitud') }}"
         data-zoom="{{ config('inmobiliaria.mapa.zoom') }}"
         style="height: 350px; border-radius: 8px;"></div>
    <small class="form-text text-muted">
        Haz clic en el mapa para colocar el marcador, o arrástralo. La dirección se llena sola cuando es posible.
    </small>
    <div class="row mt-2">
        <div class="col-md-6">
            <label for="latitud" class="form-label">Latitud</label>
            <input type="text" class="form-control @error('latitud') is-invalid @enderror"
                   id="latitud" name="latitud" value="{{ $latitud }}" readonly>
            @error('latitud')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label for="longitud" class="form-label">Longitud</label>
            <input type="text" class="form-control @error('longitud') is-invalid @enderror"
                   id="longitud" name="longitud" value="{{ $longitud }}" readonly>
            @error('longitud')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="mt-2">
        <label for="direccion" class="form-label">Dirección / referencia</label>
        <input type="text" class="form-control @error('direccion') is-invalid @enderror"
               id="direccion" name="direccion" value="{{ $direccion }}" maxlength="250"
               placeholder="Ej. Calle 60 #123, Centro, Mérida">
        @error('direccion')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <button type="button" class="btn btn-sm btn-link p-0 mt-1" id="btnQuitarUbicacion">Quitar ubicación</button>
</div>
