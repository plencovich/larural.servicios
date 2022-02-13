<?php

namespace App\Http\Livewire\Backoffice\Events;

use App\Models\Event;
use App\Helpers\Helper;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Edit extends Component
{
    public $event;
    public $name;

    public function mount(Event $event)
    {
        $this->event = $event;
        $this->name = $event->name;
    }

    public function render()
    {
        return view('livewire.backoffice.events.edit', [
            'budgets' => $this->event->budgets
        ]);
    }

    public function rules()
    {
        return [
            'name' => ['required', Rule::unique('events')->ignore($this->event->id)],
        ];
    }

    /**
     * Update the event
     *
     * @return mixed
     */
    public function update()
    {
        $this->validate();

        // Create event
        $this->event->update([
            'name' => $this->name
        ]);

        // Emit message if success
        $this->emit('success', __('events.alert.update.success'), sprintf(__('events.alert.update.message'), $this->name));

        // Emit event to dynamically add event to the calendar
        $this->emit('updateEvent', Helper::getEventData($this->event->fresh()));

        // Hide modal
        $this->emit('hideModal');
    }
}
