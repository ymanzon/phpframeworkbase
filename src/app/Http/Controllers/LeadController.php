<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Services\NotificadorLead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    // Formulario público (sección de contacto y ficha de propiedad).
    // Guarda el lead, avisa por los canales configurados y regresa
    // con mensaje de éxito. Si un canal falla, el lead queda guardado.
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|email|max:150',
            'telefono' => 'nullable|string|max:30',
            'mensaje' => 'required|string|max:1000',
            'inmueble_id' => 'nullable|exists:inmuebles,id',
            'origen' => 'nullable|string|max:50',
        ]);

        $lead = Lead::create($data);

        NotificadorLead::enviar($lead);

        return back()->with('success', 'Gracias por escribirnos, ' . $lead->nombre . '. Te contactaremos pronto.');
    }

    // Panel: bandeja de leads, los más recientes primero.
    public function index()
    {
        $leads = Lead::with('inmueble')->latest()->paginate(20);

        return view('leads.index', compact('leads'));
    }

    // Marca un lead como leído.
    public function marcarLeido(Lead $lead)
    {
        $lead->update(['leido' => true]);

        return back()->with('success', 'Lead marcado como leído.');
    }
}
