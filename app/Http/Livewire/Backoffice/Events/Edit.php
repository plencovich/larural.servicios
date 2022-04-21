<?php

namespace App\Http\Livewire\Backoffice\Events;

use App\Models\Event;
use App\Helpers\Helper;
use App\Models\Item;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Edit extends Component
{
    use AuthorizesRequests;

    public $event;
    public $name;

    public function mount(Event $event)
    {
        $this->event = $event;
        $this->name = $event->name;
    }

    public function render()
    {
        $this->authorize('update', $this->event);
        return view('livewire.backoffice.events.edit', [
            'budgets' => $this->event->budgets->load('customer'),
            'items' => Item::with(['product'])
                ->whereIn('budget_id', $this->event->budgets->pluck('id')->all())
                ->groupBy('product_id')
                ->selectRaw('*, sum(product_qty) as total_products')
                ->get()
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
        $this->authorize('update', $this->event);

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
