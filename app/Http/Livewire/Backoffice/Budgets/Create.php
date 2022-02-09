<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use App\Models\Budget;
use App\Models\Customer;
use App\Models\Event;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Create extends Component
{

    public $customer_id;
    public $event_id;

    protected $listeners = ['updateSelect' => 'updateSelect'];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function rules()
    {
        return [
            'customer_id' => ['required'],
            'event_id' => ['required'],
        ];
    }

    public function store()
    {
        $this->validate();

        // Get event
        $event = Event::findOrFail($this->event_id);

        $budget = Budget::create(
            [
                'customer_id' => $this->customer_id,
                'event_id' => $this->event_id,
                'event_from' => $event->event_from,
                'event_to' => $event->event_to,
                'status_budget_id' => 1,
            ]
        );
        //$this->emit('success', __('budgets.alert.create.success'), sprintf(__('budgets.alert.create.message'), $this->event_id));
        $this->reset();
        $this->emit('hideModal');
        $this->emit('customerShow', 'backoffice.budgets.create-items', $budget->fresh());
    }

    public function render()
    {
        $customers = Customer::all();
        $events = Event::fromNowOn()->get();
        return view('livewire.backoffice.budgets.create', compact('customers', 'events'));
    }

    /**
     * Update select 2 model
     *
     * @return mixed
     */
    public function updateSelect($property, $value)
    {
        $this->$property = $value;
    }
}
