<?php

namespace App\Policies;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BudgetPolicy
{
    use HandlesAuthorization;

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
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Budget $budget)
    {
        return $user->hasAnyRole(['Admin', 'Servicios Feriales 1', 'Servicios Feriales 2', 'Encargado de depósito']);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasAnyRole(['Admin', 'Servicios Feriales 1', 'Servicios Feriales 2', 'Comercial 1']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Budget $budget)
    {
        return $user->hasAnyRole(['Admin', 'Servicios Feriales 1', 'Servicios Feriales 2']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Budget $budget)
    {
        return $user->hasAnyRole(['Admin', 'Servicios Feriales 1', 'Servicios Feriales 2']);
    }
}
