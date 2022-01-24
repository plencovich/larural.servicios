<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use App\Models\Budget;
use App\Models\Customer;
use App\Notifications\BudgetNewNotification;
use Livewire\Component;

class CreateItems extends Component
{

    public $budget;
    public $event_from_at;
    public $event_to_at;

    public $fromUrl;

    public function mount(Budget $budget)
    {
        $this->fromUrl = request()->routeIs('backoffice.budgets.edit', $budget);

        $this->budget = $budget;
        if ($budget->event_from_at) {
            $this->event_from_at = $budget->event_from_at->format('Y-m-d');
        }
        if ($budget->event_to_at) {
            $this->event_to_at = $budget->event_to_at->format('Y-m-d');
        }
    }

    public function rules()
    {
        return [
            'budget.event_name' => ['required', 'unique:budgets,event_name,' . $this->budget->id],
            'event_from_at' => ['required', 'unique:budgets,event_from_at,' . $this->budget->id],
            'event_to_at' => ['required', 'unique:budgets,event_from_at,' . $this->budget->id],
            'budget.discount' => ['required', 'integer'],
            'budget.observations' => ['required'],
            'budget.customer_id' => ['required'],
        ];
    }

    public function store()
    {
        $this->validate();
        $this->budget->event_from_at = $this->event_from_at;
        $this->budget->event_to_at = $this->event_to_at;
        $this->budget->save();
        $this->budget->customer->notify(new BudgetNewNotification($this->budget));

        if ($this->fromUrl) {
            return redirect()->route('backoffice.events');
        } else {
            //$this->emit('success', __('budgets.alert.create.success'), sprintf(__('budgets.alert.create.message'), $this->eventName));
            $this->reset();
            $this->emit('customerShow', false);
        }
    }


    public function render()
    {
        $customers = Customer::all();
        return view('livewire.backoffice.budgets.create-items', compact('customers'));
    }
}
