<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use App\Models\Budget;
use Livewire\Component;

class Delete extends Component
{
    public $budget;

    public function mount(Budget $budget)
    {
        $this->budget = $budget;
    }

    public function delete()
    {
        $this->budget->delete();
        $this->emit('success', __('budgets.success_delete'), sprintf(__('budgets.message.delete'), $this->budget->event_name));
        $this->emit('hideModal');
        $this->emit('refresh');
    }

    public function render()
    {
        return view('livewire.backoffice.budgets.delete');
    }
}
