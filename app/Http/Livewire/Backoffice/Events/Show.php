<?php

namespace App\Http\Livewire\Backoffice\Events;

use App\Helpers\Helper;
use App\Models\Budget;
use App\Models\Event;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Show extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewAny', Event::class);
        return view('livewire.backoffice.events.show', [
            'events' => Event::all()->map(fn ($event) =>  Helper::getEventData($event))
        ]);
    }
}
