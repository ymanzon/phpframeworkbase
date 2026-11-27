@extends('layouts.detail')

@section('title', 'Términos y condiciones - ' . config('inmobiliaria.nombre'))

@section('content')
<section class="section" id="terminos">
    <div class="container" style="max-width: 800px;">
        <div class="section-title">
            <h2>Términos y condiciones</h2>
        </div>
        @foreach(config('inmobiliaria.textos.terminos', []) as $parrafo)
        <p style="line-height: 1.8; margin-bottom: 1rem;">{{ $parrafo }}</p>
        @endforeach
        <p><a href="{{ route('home') }}">Volver al inicio</a></p>
    </div>
</section>
@endsection
