<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use App\Models\Budget;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Create extends Component
{

    public $customerId;
    public $eventName;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function rules()
    {
        return [
            'customerId' => ['required'],
            'eventName' => ['required', 'unique:budgets,event_name'],
        ];
    }

    public function store()
    {
        $this->validate();
        $budget = Budget::create(
            [
                'customer_id' => $this->customerId,
                'event_name' => $this->eventName,
                'event_at' => null,
                'status_budget_id' => 1,
            ]
        );
        //$this->emit('success', __('budgets.alert.create.success'), sprintf(__('budgets.alert.create.message'), $this->eventName));
        $this->reset();
        $this->emit('hideModal');
        $this->emit('customerShow', 'backoffice.budgets.create-items', $budget->fresh());
    }

    public function render()
    {
        $customers = Customer::all();
        return view('livewire.backoffice.budgets.create', compact('customers'));
    }
}
