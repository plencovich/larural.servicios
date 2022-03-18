<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view configuration.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewConfig(User $user)
    {
        return $user->hasAnyRole(['Admin']);
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasAnyRole(['Admin', 'Superior de operaciones']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model)
    {
        // Role "Superior de operaciones" can only edit users with role "Encargado trasladar mobiliario"
        if ($user->hasRole('Superior de operaciones')) {
            return $model->hasRole('Encargado trasladar mobiliario');
        }

        return $user->hasAnyRole(['Admin']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        // Role "Superior de operaciones" can only delete users with role "Encargado trasladar mobiliario"
        if ($user->hasRole('Superior de operaciones')) {
            return $model->hasRole('Encargado trasladar mobiliario');
        }

        return $user->hasAnyRole(['Admin']);
    }
}
