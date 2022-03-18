<?php

namespace App\Http\Livewire\Backoffice\Events;

use App\Models\Event;
use App\Models\EventRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ApproveRequest extends Component
{
    use AuthorizesRequests;

    public $eventRequest;

    public function mount(EventRequest $eventRequest)
    {
        $this->eventRequest = $eventRequest;
    }

    public function render()
    {
        return view('livewire.backoffice.events.approve-request');
    }

    public function approve()
    {
        $this->authorize('update', $this->eventRequest);

        // Approve request
        $this->eventRequest->update([
            'status' => true
        ]);

        // Add event
        Event::create([
            'name' => $this->eventRequest->name,
            'event_from' => $this->eventRequest->event_from,
            'event_to' => $this->eventRequest->event_to,
        ]);

        // Refresh and show message
        $this->emit('success', __('events.success_approve'), sprintf(__('events.message.approve'), $this->eventRequest->name));
        $this->emit('hideModal');
        $this->emit('refresh');
    }
}
