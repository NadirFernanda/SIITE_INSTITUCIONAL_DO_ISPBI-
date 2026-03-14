<?php

namespace App\Policies;

use App\Models\Noticia;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NoticiaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, Noticia $noticia): bool
    {
        // Published noticias are public; unpublished only visible to admin
        return $noticia->publicada || $user->hasRole('admin');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Noticia $noticia): bool
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, Noticia $noticia): bool
    {
        return $user->hasRole('admin');
    }

    public function restore(User $user, Noticia $noticia): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Noticia $noticia): bool
    {
        return $user->hasRole('admin');
    }
}
