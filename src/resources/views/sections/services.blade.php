<!-- Services Section -->
<!-- Servicios desde config/inmobiliaria.php (clave 'servicios'): cambia la lista ahí y cambia aquí, sin tocar esta vista. -->
@php
    $iconos = [
        'Venta de propiedades' => 'fa-search-dollar',
        'Renta y administración' => 'fa-hand-holding-usd',
        'Crédito hipotecario' => 'fa-credit-card',
        'Inversión inmobiliaria' => 'fa-sign',
        'Asesoría legal' => 'fa-building',
        'Valuación de propiedades' => 'fa-file-signature',
    ];
    $descripciones = [
        'Venta de propiedades' => 'Te ayudamos a encontrar la casa o departamento perfecto para ti y tu familia con las mejores condiciones del mercado.',
        'Renta y administración' => 'Encuentra el lugar ideal para rentar con opciones flexibles y procesos rápidos y seguros. Gestión completa de tu propiedad para rentabilidad máxima y tranquilidad total.',
        'Crédito hipotecario' => 'Te ayudamos a obtener el mejor financiamiento acorde al perfil de cada cliente.',
        'Inversión inmobiliaria' => 'Asesoría especializada en inversiones inmobiliarias para maximizar tu rentabilidad y patrimonio.',
        'Asesoría legal' => 'Acompañamiento completo en todos los trámites legales y documentación necesaria.',
        'Valuación de propiedades' => 'Obtén el valor real de tu propiedad con nuestro servicio de valuación profesional.',
    ];
@endphp
    <section class="section" id="services">
        <div class="container">
            <div class="section-title">
                <h2>Nuestros Servicios</h2>
                <p>Ofrecemos soluciones inmobiliarias integrales para satisfacer todas sus necesidades de propiedad.</p>
            </div>
            <div class="services-grid">
                @foreach(config('inmobiliaria.servicios') as $servicio)
                <div class="service-card">
                    <i class="fas {{ $iconos[$servicio['titulo']] ?? 'fa-home' }}"></i>
                    <h3>{{ $servicio['titulo'] }}</h3>
                    <p>{{ $servicio['descripcion'] ?: ($descripciones[$servicio['titulo']] ?? '') }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
