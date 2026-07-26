<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // NOTE: 'role' is intentionally NOT in $fillable to prevent mass-assignment
        // privilege escalation. Set it explicitly via forceFill() or direct assignment.
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'aprovado'          => 'boolean',
    ];

    /**
     * Verifica se o usuário possui determinado papel (role).
     * Exemplo simples: campo 'role' na tabela users.
     */
    // Normalize a role string to a slug-like lowercase alphanumeric form
    public static function normalizeRole(string $role): string
    {
        $role = (string) $role;
        $norm = @iconv('UTF-8', 'ASCII//TRANSLIT', $role);
        $norm = mb_strtolower($norm);
        return preg_replace('/[^a-z0-9]/', '', $norm);
    }

    /**
     * Retorna a versão normalizada (slug) do role armazenado no utilizador.
     */
    public function getRoleSlugAttribute(): string
    {
        return self::normalizeRole($this->role ?? '');
    }

    /**
     * Verifica se o usuário possui determinado papel (role).
     * Normaliza ambos os lados da comparação para evitar problemas com acentos,
     * espaços, underscores ou diferença de capitalização.
     */
    public function hasRole($role): bool
    {
        return self::normalizeRole($this->role ?? '') === self::normalizeRole((string) $role);
    }
}
