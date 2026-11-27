@extends('layouts.detail')

@section('title', 'Aviso de privacidad - ' . config('inmobiliaria.nombre'))

@section('content')
<section class="section" id="aviso-privacidad">
    <div class="container" style="max-width: 800px;">
        <div class="section-title">
            <h2>Aviso de privacidad</h2>
        </div>
        @foreach(config('inmobiliaria.textos.aviso_privacidad', []) as $parrafo)
        <p style="line-height: 1.8; margin-bottom: 1rem;">{{ $parrafo }}</p>
        @endforeach
        <p><a href="{{ route('home') }}">Volver al inicio</a></p>
    </div>
</section>
@endsection
