<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use Livewire\Component;
use App\Models\BudgetRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DeclineRequest extends Component
{
    use AuthorizesRequests;

    public $budgetRequest;

    public function mount(BudgetRequest $budgetRequest)
    {
        $this->budgetRequest = $budgetRequest;
    }

    public function render()
    {
        return view('livewire.backoffice.budgets.decline-request');
    }

    public function decline()
    {
        $this->authorize('update', $this->budgetRequest);

        // Decline request
        $this->budgetRequest->update([
            'status' => false
        ]);

        // Refresh and show message
        $this->emit('success', __('budgets.success_decline'), sprintf(__('budgets.message.decline'), $this->budgetRequest->name));
        $this->emit('hideModal');
        $this->emit('refresh');
    }
}
