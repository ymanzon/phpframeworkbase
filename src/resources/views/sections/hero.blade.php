 <!-- Hero Section -->
    {{-- La imagen del hero puede ser una URL remota (http(s), se usa directo)
         o un archivo en public/ (se usa solo si el archivo existe). --}}
    @php $heroImagen = config('inmobiliaria.hero.imagen'); $heroEsUrl = str_starts_with($heroImagen, 'http'); @endphp
    <section class="hero" id="home" @if($heroEsUrl || file_exists(public_path(ltrim($heroImagen, '/')))) style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ $heroImagen }}')" @endif>
        <div class="hero-content">
            <h1>{{ config('inmobiliaria.hero.titulo') }}</h1>
            <p>{{ config('inmobiliaria.hero.subtitulo') }}</p>
			<button class="btn" onclick="document.getElementById('properties').scrollIntoView()">
                {{ config('inmobiliaria.hero.texto_boton_principal') }} <i class="fas fa-arrow-down"></i>
            </button>
        </div>
    </section>