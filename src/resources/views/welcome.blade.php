@extends('layouts.landing')


@section('title', 'Bienvenidos - Sistema de Inmuebles')


<!-- Properties Section -->
 @section('content')
    @if(config('inmobiliaria.secciones.destacadas'))
    <section class="section properties" id="properties">
        <div class="container">
            <div class="section-title">
                <h2>Propiedades Disponibles</h2>
                <p>Explora nuestra selección curada de propiedades premium en ubicaciones privilegiadas.</p>
            </div>
            @if(config('inmobiliaria.secciones.buscador'))
            <div class="properties-filter">
                <button class="filter-btn active" data-filter="todo">Todo</button>
                <button class="filter-btn" data-filter="Merida">Merida</button>
                <button class="filter-btn" data-filter="Monterrey">Monterrey</button>
                <button class="filter-btn" data-filter="Campeche">Campeche</button>
                <button class="filter-btn" data-filter="Progreso">Progreso</button>
                
            </div>
            <div class="filters-bar">
                <select id="filtroOperacion" class="filter-select" aria-label="Operación">
                    <option value="todas">Venta y renta</option>
                    <option value="Venta">Venta</option>
                    <option value="Renta">Renta</option>
                </select>
                <input type="number" id="filtroPrecioMax" class="filter-input" placeholder="Precio máximo ($)" min="0" step="1000" aria-label="Precio máximo">
                <select id="filtroRecamaras" class="filter-select" aria-label="Recámaras mínimas">
                    <option value="">Recámaras (todas)</option>
                    <option value="1">1+ recámaras</option>
                    <option value="2">2+ recámaras</option>
                    <option value="3">3+ recámaras</option>
                    <option value="4">4+ recámaras</option>
                </select>
                <select id="filtroOrden" class="filter-select" aria-label="Ordenar por">
                    <option value="recientes" @selected(config('inmobiliaria.orden_propiedades') === 'recientes')>Más recientes</option>
                    <option value="precio_menor" @selected(config('inmobiliaria.orden_propiedades') === 'precio_menor')>Menor precio</option>
                    <option value="precio_mayor" @selected(config('inmobiliaria.orden_propiedades') === 'precio_mayor')>Mayor precio</option>
                </select>
                <button type="button" id="limpiarFiltros" class="filter-btn">Limpiar filtros</button>
            </div>
            @endif
            <div class="properties-grid" id="propertiesGrid">

                <div id="preloader" class="preloader">
                    <div class="loader">
                        <div class="spinner"></div>
                        <p class="loading-text">Cargando...</p>
                    </div>
                </div>
               
            </div>


            
        </div>
    </section>
    @endif
@endsection