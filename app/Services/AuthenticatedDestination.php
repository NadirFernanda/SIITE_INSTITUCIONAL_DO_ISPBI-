<?php

namespace App\Services;

use App\Models\User;

class AuthenticatedDestination
{
    public function forUser(User $user): string
    {
        // Use exact roles; a redirect must never infer privileges from a substring.
        $role = $user->role_slug;
        $routes = [
            'admin' => 'admin',
            'daac' => 'daac.candidaturas.index',
            'tecnico' => 'tecnico.candidaturas.index',
            'lancamento' => 'lancamento.salas.index',
            'subcomissaolancamento' => 'lancamento.salas.index',
            'professor' => 'professor.candidaturas.index',
            'subcomissaocorrecao' => 'professor.candidaturas.index',
            'presidencia' => 'presidencia.salas.index',
            'secretaria' => 'secretaria.candidaturas.index',
            'alumni' => $user->aprovado ? 'portal.dashboard' : 'portal.pendente',
        ];

        foreach ($routes as $profile => $route) {
            if ($role === User::normalizeRole($profile)) {
                return route($route, absolute: false);
            }
        }

        return route('login', absolute: false);
    }
}
