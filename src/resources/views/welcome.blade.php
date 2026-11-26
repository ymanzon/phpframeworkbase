@extends('layouts.landing')


@section('title', 'Bienvenidos - Sistema de Inmuebles')


<!-- Properties Section -->
 @section('content')
    <section class="section properties" id="properties">
        <div class="container">
            <div class="section-title">
                <h2>Propiedades Disponibles</h2>
                <p>Explora nuestra selección curada de propiedades premium en ubicaciones privilegiadas.</p>
            </div>
            <div class="properties-filter">
                <button class="filter-btn active" data-filter="todo">Todo</button>
                <button class="filter-btn" data-filter="Merida">Merida</button>
                <button class="filter-btn" data-filter="Monterrey">Monterrey</button>
                <button class="filter-btn" data-filter="Campeche">Campeche</button>
                <button class="filter-btn" data-filter="Progreso">Progreso</button>
                
            </div>
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
@endsection