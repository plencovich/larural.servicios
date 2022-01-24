<?php

namespace App\Http\Livewire\Backoffice\Events;

use App\Models\Budget;
use Livewire\Component;

class Show extends Component
{
    public function render()
    {
        return view('livewire.backoffice.events.show', [
            'events' => Budget::all()->map(fn ($budget) =>  [
                'title' => $budget->event_name,
                'start' => $budget->event_from_at ? $budget->event_from_at->format('Y-m-d H:i:s') : null,
                'end' => $budget->event_to_at ? $budget->event_to_at->endOfDay()->format('Y-m-d H:i:s') : null,
            ])
        ]);
    }
}
