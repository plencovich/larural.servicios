<?php

namespace App\Http\Livewire\Backoffice\Events;

use Livewire\Component;
use App\Models\EventRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DeclineRequest extends Component
{
    use AuthorizesRequests;

    public $eventRequest;

    public function mount(EventRequest $eventRequest)
    {
        $this->eventRequest = $eventRequest;
    }

    public function render()
    {
        return view('livewire.backoffice.events.decline-request');
    }

    public function decline()
    {
        $this->authorize('update', $this->eventRequest);

        // Decline request
        $this->eventRequest->update([
            'status' => false
        ]);

        // Refresh and show message
        $this->emit('success', __('events.success_decline'), sprintf(__('events.message.decline'), $this->eventRequest->name));
        $this->emit('hideModal');
        $this->emit('refresh');
    }
}
