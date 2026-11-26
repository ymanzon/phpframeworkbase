<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inmueble extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'fotos',
        'precio',
        'numero_cuartos',
        'numero_banos',
        'numero_pisos',
        'tamano_construccion',
        'tamano_terreno',
        'ciudad',
        'descripcion',
        'disponibilidad',
        'tipo'
    ];

    protected $casts = [
        'fotos' => 'array',
        'precio' => 'decimal:2',
        'numero_banos' => 'decimal:2',
        'tamano_construccion' => 'decimal:2',
        'tamano_terreno' => 'decimal:2',
        'disponibilidad' => 'boolean'
    ];

    // Accessor para mostrar el precio formateado
    public function getPrecioFormateadoAttribute()
    {
        return '$' . number_format($this->precio, 2);
    }

    // Scope para filtrar por disponibilidad
    public function scopeDisponible($query)
    {
        return $query->where('disponibilidad', true);
    }

    // Scope para filtrar por tipo
    public function scopeTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    // Scope para filtrar por ciudad
    public function scopeCiudad($query, $ciudad)
    {
        return $query->where('ciudad', $ciudad);
    }
}