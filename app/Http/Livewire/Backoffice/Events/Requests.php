<?php

namespace App\Http\Livewire\Backoffice\Events;

use App\Models\EventRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Requests extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewAny', EventRequest::class);
        return view('livewire.backoffice.events.requests');
    }
}
