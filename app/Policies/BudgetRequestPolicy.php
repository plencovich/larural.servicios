<?php

namespace App\Policies;

use App\Models\BudgetRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BudgetRequestPolicy
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
        return $user->hasAnyRole(['Admin', 'Comercial 1']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BudgetRequest  $budgetRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, BudgetRequest $budgetRequest)
    {
        return $user->hasAnyRole(['Admin']) && is_null($budgetRequest->status);
    }
}
