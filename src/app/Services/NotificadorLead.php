<?php

namespace App\Services;

use App\Mail\LeadRecibido;
use App\Models\Lead;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotificadorLead
{
    // Avisa de un lead nuevo por cada canal activo en
    // config('inmobiliaria.leads.canales') (LEAD_CANALES en .env:
    // 'correo', 'telegram' o ambos, separados por coma).
    // Cada canal es un método: para agregar uno nuevo (WhatsApp),
    // basta un método notificarPorWhatsapp() y un caso en el match.
    // Si un canal falla, el lead YA quedó guardado: solo se registra
    // el fallo en el log, no se pierde el lead ni se muestra error.
    public static function enviar(Lead $lead): void
    {
        $canales = config('inmobiliaria.leads.canales', ['correo']);

        foreach ((array) $canales as $canal) {
            try {
                match ($canal) {
                    'correo' => self::notificarPorCorreo($lead),
                    'telegram' => self::notificarPorTelegram($lead),
                    'whatsapp' => self::notificarPorWhatsapp($lead),
                    default => Log::info("Canal de leads no reconocido: {$canal}"),
                };
            } catch (\Throwable $e) {
                Log::warning("No se pudo avisar el lead {$lead->id} por {$canal}: {$e->getMessage()}");
            }
        }
    }

    protected static function notificarPorCorreo(Lead $lead): void
    {
        $destino = config('inmobiliaria.correo_leads');

        if (empty($destino)) {
            return;
        }

        Mail::to($destino)->send(new LeadRecibido($lead));
    }

    protected static function notificarPorTelegram(Lead $lead): void
    {
        $token = config('inmobiliaria.leads.telegram.token');
        $chatId = config('inmobiliaria.leads.telegram.chat_id');

        if (empty($token) || empty($chatId)) {
            return;
        }

        $propiedad = $lead->inmueble ? $lead->inmueble->nombre : 'Formulario general';
        $texto = 'Nuevo lead - ' . config('inmobiliaria.nombre') . "\n"
            . 'Nombre: ' . $lead->nombre . "\n"
            . 'Telefono: ' . ($lead->telefono ?: '-') . "\n"
            . 'Correo: ' . $lead->correo . "\n"
            . 'Propiedad: ' . $propiedad . "\n"
            . 'Mensaje: ' . $lead->mensaje;

        Http::timeout(5)->post(
            "https://api.telegram.org/bot{$token}/sendMessage",
            ['chat_id' => $chatId, 'text' => $texto]
        )->throw();
    }

    // WhatsApp queda para después: requiere la API en la nube de Meta
    // (cuenta de Meta Business, número verificado y plantilla aprobada).
    // Cuando se active, este método envía la plantilla al número destino.
    protected static function notificarPorWhatsapp(Lead $lead): void
    {
        Log::info("Canal WhatsApp de leads aun no configurado (lead {$lead->id}).");
    }
}
