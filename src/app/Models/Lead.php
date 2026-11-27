<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'mensaje',
        'inmueble_id',
        'origen',
        'leido',
    ];

    protected $casts = [
        'leido' => 'boolean',
    ];

    public function inmueble(): BelongsTo
    {
        return $this->belongsTo(Inmueble::class);
    }
}
