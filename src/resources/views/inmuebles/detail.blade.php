@extends('layouts.detail')


@section('title', 'Bienvenidos - Sistema de Inmuebles')

<!-- Properties Section -->
 @section('content')
 <!-- Breadcrumb -->
        <section class="breadcrumb">
            <div class="container">
                <div class="breadcrumb-container">
                    <a href="/">Inicio</a>
                    <span class="separator"><i class="fas fa-chevron-right"></i></span>
                    <a href="/#properties">Propiedades</a>
                    <span class="separator"><i class="fas fa-chevron-right"></i></span>
                    <span id="breadcrumbTitle">Detalle de Propiedad</span>
                </div>
            </div>
        </section>

        <!-- Property Detail -->
        <section class="property-detail">
            <div class="container">
                <a href="/#properties" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    Volver a Propiedades
                </a>

                <div id="propertyContent">
                    <!-- Content will be loaded here by JavaScript -->
                </div>
            </div>
        </section>
@endsection

@section('scripts')
    <script>

         // Get property ID from URL
        function getPropertyIdFromUrl() {
        //    const urlParams = new URLSearchParams(window.location.search);
          //  const id = urlParams.get('id');
            return {{ $id }}; // Assuming you pass the property ID from the backend
        }
       
       function displayPropertyDetail(property) 
       {
            const propertyId = getPropertyIdFromUrl();
            //const property = properties.find(p => p.id === propertyId);
            const contentDiv = document.getElementById('propertyContent');
            const breadcrumbTitle = document.getElementById('breadcrumbTitle');

            console.log(property);

            if (!property) {
                contentDiv.innerHTML = `
                    <div class="error-message">
                        <h2><i class="fas fa-exclamation-triangle"></i> Propiedad no encontrada</h2>
                        <p>Lo sentimos, no pudimos encontrar la propiedad que buscas.</p>
                        <a href="../detail.html#properties" class="btn">
                            <i class="fas fa-arrow-left"></i> Volver a Propiedades
                        </a>
                    </div>
                `;
                return;
            }

            // Update page title and breadcrumb
            document.title = `${property.nombre} - {{ config('inmobiliaria.nombre') }}`;
            breadcrumbTitle.textContent = property.nombre;

            // Generate image gallery
            const mainImage = property.fotos && property.fotos.length > 0 ? property.fotos[0] : '../fotos/default.jpg';
            let thumbnailsHtml = '';
            
            if (property.fotos && property.fotos.length > 1) {
                thumbnailsHtml = property.fotos.map((img, index) => `
                    <div class="thumbnail ${index === 0 ? 'active' : ''}" onclick="changeMainImage('${img}', ${index})">
                        <img src="/storage/${img}" alt="Vista ${index + 1}">
                    </div>
                `).join('');
            }

            // Generate property badges
            let badgesHtml = '';
            if (property.featured) {
                badgesHtml += '<span class="badge badge-featured">Destacado</span>';
            }
            badgesHtml += `<span class="badge badge-type">${capitalizeFirst(property.tipo)}</span>`;
            badgesHtml += `<span class="badge badge-city">${capitalizeFirst(property.ciudad)}</span>`;

            contentDiv.innerHTML = `
                <div class="property-header">
                    <h1 class="property-title">${property.nombre}</h1>
                    <div class="property-location">
                        <i class="fas fa-map-marker-alt"></i>
                        ${property.ciudad}
                    </div>
                    <div class="property-price">
                        ${ formatNumber( property.precio )}
                        <span>/ ${ property.tipo }</span>
                    </div>
                    <div class="property-badges">
                        ${badgesHtml}
                    </div>
                </div>

                <div class="property-content">
                    <div class="property-main">
                        <div class="image-gallery">
                            <div class="main-image">
                                <img id="mainImage" src="/storage/${mainImage}" alt="${property.nombre}">
                            </div>
                            ${property.fotos && property.fotos.length > 1 ? `
                                <div class="thumbnail-gallery">
                                    ${thumbnailsHtml}
                                </div>
                            ` : ''}
                        </div>
                        
                        ${property.descripcion ? `
                            <div class="info-section">
                                <h3><i class="fas fa-info-circle"></i> Descripción</h3>
                                <p style="color: var(--text-light); line-height: 1.8; font-size: 1.1rem;">
                                    ${ property.descripcion ? stringToHtml(property.descripcion) : 'No hay descripción disponible.'}
                                </p>
                            </div>
                        ` : ''}
                    </div>

                    <div class="property-info">
                        <div class="info-section">
                            <h3><i class="fas fa-home"></i> Características</h3>
                            <div class="features-grid">
                                <div class="feature-item">
                                    <i class="fas fa-bed"></i>
                                    <div class="feature-content">
                                        <div class="feature-label">Cuartos</div>
                                        <div class="feature-value">${property.numero_cuartos}</div>
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-bath"></i>
                                    <div class="feature-content">
                                        <div class="feature-label">Baños</div>
                                        <div class="feature-value">${ formatNumberwhiouthDecimals( property.numero_banos )}</div>
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-layer-group"></i>
                                    <div class="feature-content">
                                        <div class="feature-label">Pisos</div>
                                        <div class="feature-value">${property.numero_pisos} m²</div>
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-ruler-combined"></i>
                                    <div class="feature-content">
                                        <div class="feature-label">Construcción</div>
                                        <div class="feature-value">${formatNumber(property.tamano_construccion)} m²</div>
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-expand-arrows-alt"></i>
                                    <div class="feature-content">
                                        <div class="feature-label">Terreno</div>
                                        <div class="feature-value">${ formatNumber(property.tamano_terreno)}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="info-section">
                            <h3> Precio</h3>
                            <div style="font-size: 1.8rem; font-weight: 700; color: var(--secondary); text-align: center; padding: 20px; background: var(--light); border-radius: 10px;">
                                $${formatNumber(property.precio)}
                                <div style="font-size: 1rem; color: var(--text-light); font-weight: 400; margin-top: 5px;">
                                    ${property.tipo}
                                </div>
                            </div>
                        </div>

                        <a href="https://wa.me/{{ config('inmobiliaria.whatsapp') }}?text=Estoy%20interesado%20en%20${encodeURIComponent(property.nombre)}%20por%20${property.precio}" 
                           class="whatsapp-btn" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                            Contactar Agente
                        </a>
                    </div>
                </div>
            `;
        }

        // Change main image function
        function changeMainImage(src, index) {
            const mainImage = document.getElementById('mainImage');
            const thumbnails = document.querySelectorAll('.thumbnail');
            
            mainImage.src ='/storage/'+ src;
            
            thumbnails.forEach(thumb => thumb.classList.remove('active'));
            thumbnails[index].classList.add('active');
        }

        // Utility function to capitalize first letter
        function capitalizeFirst(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const navLinks = document.getElementById('navLinks');

        mobileMenuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            mobileMenuBtn.innerHTML = navLinks.classList.contains('active') ? 
                '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
        });

        // Initialize page
        document.addEventListener('DOMContentLoaded', () => {

            //request ajax to get property data
            // Assuming you have a global `properties` array available  
            $.ajax({
                url: '/api/inmuebles/' + {{ $id }},
                method: 'GET',
                success: function(request) {
                    //properties = request.data; // Assuming the response is an array of properties
                    displayPropertyDetail( request.data );
                },
                error: function() {
                    document.getElementById('propertyContent').innerHTML = `
                        <div class="error-message">
                            <h2><i class="fas fa-exclamation-triangle"></i> Error al cargar la propiedad</h2>
                            <p>Lo sentimos, no pudimos cargar los detalles de la propiedad.</p>
                            <a href="../detail.html#properties" class="btn">
                                <i class="fas fa-arrow-left"></i> Volver a Propiedades
                            </a>
                        </div>
                    `;
                }
            });


            //displayPropertyDetail();
        });

        function formatNumber(price) {
            const formatter = new Intl.NumberFormat("en-US", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });
            result = formatter.format(price);

            console.log(result);
            return result;
        }


   function formatNumber(price) {
    const formatter = new Intl.NumberFormat("en-US", {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
    });
    result = formatter.format(price);

    return result;
}

function formatNumberwhiouthDecimals(value) {
    const formatter = new Intl.NumberFormat("en-US", {
        minimumFractionDigits: 1,
        maximumFractionDigits: 1,
    });
    result = formatter.format(value);

    return result;
}

//format text

function stringToHtml(jsonString) {
    let text;

    // Intentar parsear si es JSON válido
    try {
        let parsed = JSON.parse(jsonString);
        text = (typeof parsed === 'string') ? parsed : jsonString;
    } catch (e) {
        text = jsonString; // Si no es JSON, usamos el string tal cual
    }

    // Normalizar saltos de línea (\n)
    text = text.trim().replace(/\r\n|\r/g, '\n');

    // Dividir en líneas y envolver en <p>
    return text
        .split('\n')
        .filter(line => line.trim().length > 0) // evitar líneas vacías
        .map(line => `<p>${line.trim()}</p>`)
        .join('\n');
}


    </script>
@endsection