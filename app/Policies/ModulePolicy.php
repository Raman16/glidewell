<?php

namespace App\Policies;

use App\Modules;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModulePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Modules  $modules
     * @return mixed
     */
    public function view(User $user, Modules $modules)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
        
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Modules  $modules
     * @return mixed
     */
    public function update(User $user, Modules $modules)
    {
        return $user->id==$modules->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Modules  $modules
     * @return mixed
     */
    public function delete(User $user, Modules $modules)
    {
        //
        return $user->id==$modules->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Modules  $modules
     * @return mixed
     */
    public function restore(User $user, Modules $modules)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Modules  $modules
     * @return mixed
     */
    public function forceDelete(User $user, Modules $modules)
    {
        //
    }
}
