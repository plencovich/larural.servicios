<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use App\Models\Budget;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Delete extends Component
{
    use AuthorizesRequests;

    public $budget;

    public function mount(Budget $budget)
    {
        $this->budget = $budget;
    }

    public function delete()
    {
        $this->authorize('delete', $this->budget);
        $this->budget->delete();
        $this->emit('success', __('budgets.success_delete'), sprintf(__('budgets.message.delete'), $this->budget->event_name));
        $this->emit('hideModal');
        $this->emit('refresh');
    }

    public function render()
    {
        $this->authorize('delete', $this->budget);
        return view('livewire.backoffice.budgets.delete');
    }
}
