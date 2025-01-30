<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user)
    {
        // Allow admins and teachers to view users
        return $user->role === 'admin' || $user->role === 'teacher';
    }

    public function create(User $user)
    {
        return $user->role === 'admin';
    }
}
