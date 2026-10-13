<?php

namespace App\Policies;

use App\Models\Candidatura;
use App\Models\User;

class CandidaturaPolicy
{
    public function downloadComprovativo(User $user, Candidatura $candidatura): bool
    {
        return in_array($user->role_slug, array_map(User::normalizeRole(...), [
            'admin', 'daac', 'tecnico',
        ]), true);
    }
}
