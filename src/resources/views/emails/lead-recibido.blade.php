<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo lead - {{ config('inmobiliaria.nombre') }}</title>
</head>
<body style="font-family: sans-serif; color: #222;">
    <h2>Nuevo lead en {{ config('inmobiliaria.nombre') }}</h2>
    <p><strong>Nombre:</strong> {{ $lead->nombre }}</p>
    <p><strong>Correo:</strong> {{ $lead->correo }}</p>
    <p><strong>Teléfono:</strong> {{ $lead->telefono ?: '—' }}</p>
    <p><strong>Propiedad:</strong> {{ $lead->inmueble ? $lead->inmueble->nombre : 'Formulario general' }}</p>
    <p><strong>Origen:</strong> {{ $lead->origen ?: '—' }}</p>
    <p><strong>Mensaje:</strong></p>
    <p>{{ $lead->mensaje }}</p>
    <p style="color: #666; font-size: 13px;">Recibido el {{ $lead->created_at->format('d/m/Y H:i') }}. También puedes verlo en el panel, en la bandeja de Leads.</p>
</body>
</html>
