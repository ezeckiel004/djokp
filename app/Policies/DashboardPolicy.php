<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DashboardPolicy
{
    use HandlesAuthorization;

    public function viewAdmin(User $user)
    {
        return $user->hasRole('admin');
    }

    public function viewClient(User $user)
    {
        return $user->hasRole('client');
    }

    public function viewChauffeur(User $user)
    {
        return $user->hasRole('chauffeur');
    }

    public function viewFormateur(User $user)
    {
        return $user->hasRole('formateur');
    }
}
