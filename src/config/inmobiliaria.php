<?php
// config/inmobiliaria.php — PLANTILLA de configuración para Laravel.
// VERSIÓN CON LAS ADICIONES FASE 1 YA PEGADAS (23 nov 2026).
// Es config-ejemplo.php + los 5 bloques de config-adiciones-fase-1.md, ya integrados.
// El paquete para el diseñador (config-ejemplo.php original) queda intacto.
// Para usarlo: cópialo como config/inmobiliaria.php en tu proyecto Laravel y corre php -l.
// Fase 1: cambia SOLO este archivo (y tu .env) para personalizar la
// plantilla para cada cliente, sin tocar las vistas Blade ni el catálogo.
// En tus vistas usa config('inmobiliaria.nombre'), config('inmobiliaria.whatsapp'),
// etc., en lugar de dejar el nombre, teléfono o correo escritos a mano.
// Identidad de ejemplo UNIFICADA el 2026-11-21: "Hábitat Mérida".
// Es ficticia, igual que en la vista previa de la plantilla.
// Sustituye teléfono, WhatsApp y correo de prueba por los del cliente
// real antes de publicar.

return [
    // --- Identidad de la inmobiliaria ---
    'nombre' => env('INMOBILIARIA_NOMBRE', 'Hábitat Mérida'),
    'eslogan' => 'Bienes raíces en Yucatán',
    'descripcion_corta' => 'Inmobiliaria en Mérida, Yucatán: venta y renta de casas, departamentos y terrenos.',
    'favicon' => '/logo.svg', // placeholder genérico; súbelo a storage/ y apunta aquí
    'logo' => '/logo.svg', // placeholder genérico; súbelo a storage/ y apunta aquí
    'logo_texto' => 'HM', // siglas mientras no hay archivo de logo
    'ciudad' => env('INMOBILIARIA_CIUDAD', 'Mérida, Yucatán'),
    'estado' => 'Yucatán',
    'pais' => 'México',
    'moneda' => 'MXN',
    'zonas' => ['Temozón Norte', 'Cholul', 'García Ginerés', 'Altabrisa', 'Conkal', 'Centro Histórico', 'Montebello', 'Caucel'],
    'tipos_propiedad' => ['casa', 'departamento', 'terreno', 'local'],
    'operaciones' => ['venta', 'renta'],
    'filtros_activos' => ['tipo', 'operacion', 'precio', 'zona', 'recamaras', 'banos', 'm2'],
    'anio_fundacion' => 2013,
    'anios_experiencia' => 12,
    'propiedades_vendidas' => '+350',

    // --- Hero ---
    'hero' => [
        'imagen' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=1200&q=80', // URL de Unsplash; la vista la usa directo cuando empieza por http(s)
        'titulo' => 'Casas y departamentos en venta y renta en Mérida',
        'subtitulo' => 'Te acompañamos de la primera visita a la firma: búsqueda, crédito y trámites en un solo lugar.',
        'texto_boton_principal' => 'Buscar propiedades', // texto del botón de búsqueda del hero ({texto_boton_principal})
    ],

    // --- Colores de la marca (cámbialos por los del cliente) ---
    'colores' => [
        'primario' => '#173f35',
        'secundario' => '#c08a3e',
        'acento' => '#c08a3e', // color de acento de la plantilla; el botón de WhatsApp usa este acento en el diseño
        'fondo' => '#ffffff',
        'texto' => '#222222',
    ],
    'fuente_titulos' => 'Spectral',
    'fuente_texto' => 'Archivo',
    'estilo_tarjeta' => 'foto', // foto | clasica | minimal
    'radio_bordes' => '16px', // redondez general de tarjetas y botones ({radio_bordes})

    // --- Estructura configurable: encender/apagar y reordenar secciones ---
    // Corresponde a {mostrar_buscador}, {mostrar_servicios}, {mostrar_calculadora},
    // {mostrar_testimonios} y {mostrar_formulario} del brief. El home.blade.php
    // debe recorrer 'orden_secciones' y respetar estos interruptores.
    'secciones' => [
        'hero' => true,
        'buscador' => true,
        'destacadas' => true,
        'servicios' => true,
        'calculadora' => true,
        'testimonios' => true,
        'formulario' => true,
        'contacto' => true,
    ],
    'orden_secciones' => ['hero', 'buscador', 'destacadas', 'servicios', 'calculadora', 'testimonios', 'formulario', 'contacto'],

    // --- Servicios (lista editable; el diseñador define icono y descripción final) ---
    // Corresponde a {servicios} del brief: los 6 servicios de ejemplo de la vista previa.
    // Antes solo existía 'secciones.servicios' (el interruptor para mostrar/ocultar
    // la sección), pero no la lista en sí; sin esta clave, config('inmobiliaria.servicios')
    // no devolvía nada.
    'servicios' => [
        ['titulo' => 'Venta de propiedades', 'descripcion' => '', 'icono' => ''],
        ['titulo' => 'Renta y administración', 'descripcion' => '', 'icono' => ''],
        ['titulo' => 'Crédito hipotecario', 'descripcion' => '', 'icono' => ''],
        ['titulo' => 'Inversión inmobiliaria', 'descripcion' => '', 'icono' => ''],
        ['titulo' => 'Asesoría legal', 'descripcion' => '', 'icono' => ''],
        ['titulo' => 'Valuación de propiedades', 'descripcion' => '', 'icono' => ''],
    ],

    // --- Catálogo ---
    'propiedades_por_pagina' => 9,
    'orden_propiedades' => 'recientes', // recientes | precio_menor | precio_mayor
    'mostrar_precio' => true,

    // --- Contacto (¡sustituir por los datos reales del cliente!) ---
    'telefono' => env('INMOBILIARIA_TELEFONO', '+52 999 123 4567'), // de prueba, NO publicar así
    'whatsapp' => env('INMOBILIARIA_WHATSAPP', '529991234567'), // solo dígitos: 52 + lada 999 de Mérida
    'correo' => env('INMOBILIARIA_CORREO', 'contacto@habitatmerida.mx'), // de prueba
    'correo_leads' => env('INMOBILIARIA_CORREO_LEADS', 'leads@habitatmerida.mx'),

    // --- Leads del formulario de contacto ---
    // Canales de aviso cuando llega un lead (LEAD_CANALES en .env, separados
    // por coma): 'correo' y/o 'telegram'. WhatsApp queda para después:
    // NotificadorLead ya tiene el método notificarPorWhatsapp() listo.
    'leads' => [
        'canales' => array_filter(array_map('trim', explode(',', env('LEAD_CANALES', 'correo')))),
        'telegram' => [
            'token' => env('TELEGRAM_BOT_TOKEN', ''),
            'chat_id' => env('TELEGRAM_CHAT_ID', ''),
        ],
    ],
    'direccion' => 'Calle 60 #123 x 45, Centro, Mérida, Yucatán',
    'horario' => 'Lun–Sáb 9:00–19:00',

    // --- Redes sociales del cliente (dejar vacío si no tiene) ---
    'redes' => [
        'facebook' => env('INMOBILIARIA_FACEBOOK', '/habitatmerida'),
        'instagram' => env('INMOBILIARIA_INSTAGRAM', '@habitat.merida'),
        'tiktok' => '', // vacío si el cliente no tiene
    ],
    'google_maps_embed' => '', // URL del mapa, opcional por cliente

    // --- Textos legales (se muestran en /aviso-de-privacidad y /terminos) ---
    // Textos genéricos para una inmobiliaria: adáptalos con los datos del
    // cliente antes de publicar (nombre de la empresa, correo de contacto).
    'textos' => [
        'aviso_privacidad' => [
            'La inmobiliaria responsable del tratamiento de tus datos personales es la empresa que opera este sitio web. Este aviso explica qué datos recabamos, para qué los usamos y cómo puedes ejercer tus derechos.',
            'Datos que recabamos: cuando llenas el formulario de contacto o el de una propiedad, nos compartes tu nombre, correo electrónico, teléfono y el mensaje que escribes. También registramos la propiedad sobre la que preguntas y la fecha de tu mensaje.',
            'Finalidades: usamos tus datos únicamente para atender tu solicitud, contactarte sobre la propiedad que te interesa, enviarte información relacionada y dar seguimiento a tu mensaje. No vendemos ni compartimos tus datos con terceros con fines publicitarios.',
            'Derechos ARCO: puedes acceder, rectificar, cancelar u oponerte al tratamiento de tus datos, así como revocar tu consentimiento, escribiendo al correo de contacto publicado en este sitio. Responderemos tu solicitud en los plazos que marca la Ley Federal de Protección de Datos Personales en Posesión de los Particulares.',
            'Seguridad y cambios: protegemos tus datos con medidas razonables de seguridad. Si este aviso cambia, publicaremos la versión actualizada en esta misma página.',
        ],
        'terminos' => [
            'Uso del sitio: la información de este sitio —propiedades, precios y disponibilidad— se publica con fines informativos y puede cambiar sin previo aviso. La disponibilidad y el precio final de una propiedad se confirman con un asesor.',
            'Precios y fotos: los precios están en pesos mexicanos (MXN) salvo que se indique lo contrario. Las fotos de las propiedades de ejemplo son imágenes de referencia y pueden no corresponder a la propiedad exacta.',
            'Créditos y calculadora: la calculadora hipotecaria da una estimación informativa. La mensualidad real depende del banco, la tasa vigente, el plazo, el enganche y tu perfil crediticio. La aprobación del crédito corresponde a la institución financiera.',
            'Contacto y mensajes: al enviarnos un mensaje aceptas que te contactemos por los medios que nos compartiste para atender tu solicitud, conforme a nuestro aviso de privacidad.',
            'Responsabilidad: la inmobiliaria no se hace responsable por decisiones tomadas únicamente con la información de este sitio. Para cualquier operación, se recomienda verificar la documentación legal de la propiedad con un asesor.',
        ],
    ],

    // --- Propiedades demo ---
    // Carga las 9 propiedades de Mérida en "propiedades-demo.json"
    // con un seeder (PropertySeeder) para la demo. En la versión para
    // un cliente real, el catálogo ya vive en la base de datos y se
    // gestiona desde el login / panel que ya tienes.
    // La vista previa muestra solo 6 de esas 9 para no alargar el diseño.
    'archivo_propiedades_demo' => database_path('seeders/data/propiedades-demo.json'),

    // --- Precios de TU servicio (ya definidos en el plan) ---
    // Venta única: $14,900–$19,900 · Renta: $990/mes base, $1,490/mes completa
    // Inicio/personalización: $2,990. No se muestran en la página pública;
    // son solo referencia para ti al armar la hoja de precios (Fase 4).

    'seo' => [
        'titulo' => 'Casas en venta en Mérida | Hábitat Mérida',
        'descripcion' => 'Casas, departamentos y terrenos en venta y renta en Mérida, Yucatán.',
        'keywords' => 'casas en venta Mérida, departamentos en renta Mérida, terrenos Mérida, inmobiliaria Mérida',
    ],

    // --- Texto listo para WhatsApp ---
    'whatsapp_mensaje_generico' => 'Hola, me interesa una propiedad que vi en su página. ¿Me pueden dar más información?',
];
