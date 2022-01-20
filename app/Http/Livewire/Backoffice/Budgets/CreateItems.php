<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use App\Models\Budget;
use App\Models\Customer;
use App\Notifications\BudgetNewNotification;
use Livewire\Component;

class CreateItems extends Component
{

    public $budget;

    public function mount(Budget $budget)
    {
        $this->budget = $budget;
    }

    public function rules()
    {
        return [
            'budget.event_name' => ['required', 'unique:budgets,event_name,' . $this->budget->id],
            'budget.event_at' => ['required', 'unique:budgets,event_at,' . $this->budget->id],
            'budget.disccount' => ['required', 'integer'],
            'budget.observations' => ['required'],
            'budget.customer_id' => ['required'],
        ];
    }

    public function store()
    {
        $this->validate();
        $this->budget->save();
        $this->budget->customer->notify(new BudgetNewNotification());
        //$this->emit('success', __('budgets.alert.create.success'), sprintf(__('budgets.alert.create.message'), $this->eventName));
        $this->reset();
        $this->emit('customerShow', false);
    }


    public function render()
    {
        $customers = Customer::all();
        return view('livewire.backoffice.budgets.create-items', compact('customers'));
    }
}
