<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- Roles y permisos (esquema propio, sin paquetes) ---

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Rol::class, 'rol_usuario', 'user_id', 'rol_id');
    }

    // ¿Tiene ALGUNO de los roles indicados? Ej. tieneRol('administrador', 'agente')
    public function tieneRol(string ...$roles): bool
    {
        return $this->roles()->whereIn('nombre', $roles)->exists();
    }

    public function esAdministrador(): bool
    {
        return $this->tieneRol('administrador');
    }

    // ¿Tiene el permiso indicado a través de alguno de sus roles?
    // El administrador pasa siempre.
    public function tienePermiso(string $permiso): bool
    {
        if ($this->esAdministrador()) {
            return true;
        }

        return $this->roles()
            ->whereHas('permisos', fn ($q) => $q->where('nombre', $permiso))
            ->exists();
    }
}
