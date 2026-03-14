<?php

namespace App\Policies;

use App\Models\Concurso;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ConcursoPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, Concurso $concurso): bool
    {
        // Published concursos are public; drafts only visible to admin
        return $concurso->status === 'published' || $user->hasRole('admin');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Concurso $concurso): bool
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, Concurso $concurso): bool
    {
        return $user->hasRole('admin');
    }

    public function restore(User $user, Concurso $concurso): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Concurso $concurso): bool
    {
        return $user->hasRole('admin');
    }
}
