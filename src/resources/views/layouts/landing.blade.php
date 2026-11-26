<!DOCTYPE html>
<html lang="es">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ config('inmobiliaria.seo.descripcion') }}">
    <meta name="keywords" content="inmobiliaria, inmuebles, compra, venta, alquiler, propiedades">
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
    

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/preloader.css">
    <!-- Colores de la inmobiliaria desde config/inmobiliaria.php -->
    <style>:root{--primary: {{ config('inmobiliaria.colores.primario') }}; --secondary: {{ config('inmobiliaria.colores.acento') }}; --accent: {{ config('inmobiliaria.colores.acento') }};}</style>
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
                    <li><a href="#home">Inicio</a></li>
                    <li><a href="#services">Servicios</a></li>
                    <li><a href="#properties">Propiedades</a></li>
                    <li><a href="#contact">Contacto</a></li>
                    @auth
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    @else   
                        <li class="auth-buttons-responsive"><a href="{{ route('login') }}" class="btn btn-outline" id="loginBtn">Iniciar Sesión</a></li>
                    @endauth
                </ul>
                <div class="auth-buttons">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">
                            <i class="fas fa-user"></i> Dashboard
                        </a>    
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline" id="loginBtn">Iniciar Sesión</a>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    @include('sections.hero')

   

    <!-- Contenido principal -->
    <main>
        @yield('content')
    </main>

     @include('sections.services')

    @include('sections.contact')

    <!-- Footer -->
    <footer>
        <div class="container">

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ config('inmobiliaria.nombre') }}. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="js/script.js"></script>
    
    @stack('scripts')

</body>
</html>