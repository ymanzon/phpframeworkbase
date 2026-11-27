<!DOCTYPE html>
<html lang="es">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ config('inmobiliaria.seo.descripcion') }}">
    <meta name="keywords" content="{{ config('inmobiliaria.seo.keywords') }}">
    <meta name="author" content="{{ config('inmobiliaria.nombre') }}">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ config('inmobiliaria.seo.titulo') }}">
    <meta property="og:description" content="{{ config('inmobiliaria.seo.descripcion') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta property="og:image" content="{{ config('app.url') }}{{ config('inmobiliaria.logo') }}">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ config('inmobiliaria.seo.titulo') }}">
    <meta name="twitter:description" content="{{ config('inmobiliaria.seo.descripcion') }}">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ config('app.url') }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/logo.svg">
    
    <title>@yield('title', config('inmobiliaria.nombre'))</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    

    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="../../css/preloader.css">    
    <link rel="stylesheet" href="../../css/details.css">
    @yield('styles')
    <!-- Colores, radio y fuentes de la inmobiliaria desde config/inmobiliaria.php -->
    <style>:root{--primary: {{ config('inmobiliaria.colores.primario') }}; --secondary: {{ config('inmobiliaria.colores.acento') }}; --accent: {{ config('inmobiliaria.colores.acento') }}; --color-fondo: {{ config('inmobiliaria.colores.fondo') }}; --color-texto: {{ config('inmobiliaria.colores.texto') }}; --radio-bordes: {{ config('inmobiliaria.radio_bordes') }};}
    body{font-family: '{{ config('inmobiliaria.fuente_texto') }}', sans-serif; background: var(--color-fondo); color: var(--color-texto);}
    h1,h2,h3{font-family: '{{ config('inmobiliaria.fuente_titulos') }}', serif;}
    .property-card,.service-card,.btn{border-radius: var(--radio-bordes);}</style>
</head>
<body>
    <!-- Navbar -->
     <!-- Header -->
    <header id="header">
        <div class="container">
            <nav>
                <div class="logo-container">
                    <img src="{{ config('inmobiliaria.logo') }}" alt="{{ config('inmobiliaria.nombre') }} Logo" class="logo-img">
                    <a href="#" class="logo-text">{{ config('inmobiliaria.nombre') }}</a>
                </div>
                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
                <ul class="nav-links" id="navLinks">
                    <li><a href="/#home">Inicio</a></li>
                    <li><a href="/#services">Servicios</a></li>
                    <li><a href="/#properties">Propiedades</a></li>
                    <li><a href="/#contact">Contacto</a></li>
                </ul>
                <div class="auth-buttons">
                    <a href="{{ route('login') }}" class="btn btn-outline" id="loginBtn">Iniciar Sesión</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Contenido principal -->
    <main>
        @yield('content')
    </main>


    <!-- Footer -->
    <footer>
        <div class="container">

            <div class="footer-info">
                <p>{{ config('inmobiliaria.eslogan') }} &mdash; {{ config('inmobiliaria.descripcion_corta') }}</p>
                <p>{{ config('inmobiliaria.anios_experiencia') }} a&ntilde;os de experiencia &middot; {{ config('inmobiliaria.propiedades_vendidas') }} propiedades vendidas &middot; Desde {{ config('inmobiliaria.anio_fundacion') }}</p>
                <div class="footer-social">
                    @if(config('inmobiliaria.redes.facebook'))<a href="https://facebook.com{{ config('inmobiliaria.redes.facebook') }}" target="_blank" rel="noopener"><i class="fab fa-facebook"></i></a>@endif
                    @if(config('inmobiliaria.redes.instagram'))<a href="https://instagram.com/{{ ltrim(config('inmobiliaria.redes.instagram'), '@') }}" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>@endif
                    @if(config('inmobiliaria.redes.tiktok'))<a href="https://tiktok.com/@{{ ltrim(config('inmobiliaria.redes.tiktok'), '@') }}" target="_blank" rel="noopener"><i class="fab fa-tiktok"></i></a>@endif
                </div>
                @if(config('inmobiliaria.google_maps_embed'))<iframe src="{{ config('inmobiliaria.google_maps_embed') }}" style="border:0;width:100%;height:220px" loading="lazy"></iframe>@endif
                <p>@if(config('inmobiliaria.aviso_privacidad'))<a href="{{ config('inmobiliaria.aviso_privacidad') }}">Aviso de privacidad</a>@endif @if(config('inmobiliaria.terminos'))<a href="{{ config('inmobiliaria.terminos') }}">T&eacute;rminos</a>@endif</p>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ config('inmobiliaria.nombre') }}. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @yield('scripts')
    @stack('scripts')
</body>
</html>