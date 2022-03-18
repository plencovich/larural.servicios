<?php

namespace App\Policies;

use App\Models\EventRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventRequestPolicy
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
     * @param  \App\Models\EventRequest  $eventRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, EventRequest $eventRequest)
    {
        return $user->hasAnyRole(['Admin']) && is_null($eventRequest->status);
    }
}
