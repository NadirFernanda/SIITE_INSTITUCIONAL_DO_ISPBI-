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

        // Remove Portuguese accents and special characters
        // Map ç to c (not empty string to preserve character count)
        $map = [
            'á' => 'a', 'à' => 'a', 'ã' => 'a', 'â' => 'a', 'ä' => 'a',
            'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
            'í' => 'i', 'ì' => 'i', 'î' => 'i', 'ï' => 'i',
            'ó' => 'o', 'ò' => 'o', 'õ' => 'o', 'ô' => 'o', 'ö' => 'o',
            'ú' => 'u', 'ù' => 'u', 'û' => 'u', 'ü' => 'u',
            'ç' => 'c', 'ñ' => 'n',
            'Á' => 'a', 'À' => 'a', 'Ã' => 'a', 'Â' => 'a', 'Ä' => 'a',
            'É' => 'e', 'È' => 'e', 'Ê' => 'e', 'Ë' => 'e',
            'Í' => 'i', 'Ì' => 'i', 'Î' => 'i', 'Ï' => 'i',
            'Ó' => 'o', 'Ò' => 'o', 'Õ' => 'o', 'Ô' => 'o', 'Ö' => 'o',
            'Ú' => 'u', 'Ù' => 'u', 'Û' => 'u', 'Ü' => 'u',
            'Ç' => 'c', 'Ñ' => 'n',
        ];
        $norm = strtr($role, $map);

        // Convert to lowercase and remove all non-alphanumeric characters
        $norm = mb_strtolower($norm);
        $norm = preg_replace('/[^a-z0-9]/', '', $norm);
        // Remove duplicate consecutive letters (e.g., "correccao" → "corecao")
        $norm = preg_replace('/(.)\1+/', '$1', $norm);

        return $norm;
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
     *
     * Suporta matching parcial para roles que têm sub-roles:
     * - hasRole('lancamento') faz match com "Sub. Lançamento"
     * - hasRole('correcao') faz match com "Sub. Correcção" ou "Subcomissão de Correcção"
     */
    public function hasRole($role): bool
    {
        $userRole = self::normalizeRole($this->role ?? '');
        $targetRole = self::normalizeRole((string) $role);

        // Exact match (for roles like 'admin', 'daac', 'tecnico', 'presidencia', 'secretaria', 'alumni')
        if ($userRole === $targetRole) {
            return true;
        }

        // Partial match (for sub-roles like 'lancamento' matching 'Sub. Lançamento' → 'sublancamento')
        if (str_contains($userRole, $targetRole) && strlen($targetRole) > 0) {
            return true;
        }

        return false;
    }
}
