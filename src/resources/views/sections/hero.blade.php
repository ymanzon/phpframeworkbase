 <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>{{ config('inmobiliaria.hero.titulo') }}</h1>
            <p>{{ config('inmobiliaria.hero.subtitulo') }}</p>
			<button class="btn" onclick="document.getElementById('properties').scrollIntoView()">
                {{ config('inmobiliaria.hero.texto_boton_principal') }} <i class="fas fa-arrow-down"></i>
            </button>
        </div>
    </section>