<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use App\Models\Budget;
use Livewire\Component;
use App\Models\BudgetRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApproveRequest extends Component
{
    use AuthorizesRequests;

    public $budgetRequest;

    public function mount(BudgetRequest $budgetRequest)
    {
        $this->budgetRequest = $budgetRequest;
    }

    public function render()
    {
        return view('livewire.backoffice.budgets.approve-request');
    }

    public function approve()
    {
        $this->authorize('update', $this->budgetRequest);

        // Approve request
        $this->budgetRequest->update([
            'status' => true
        ]);

        // Add budget
        Budget::create([
            'customer_id' => $this->budgetRequest->user->id,
            'event_id' => $this->budgetRequest->event->id,
            'event_from' => $this->budgetRequest->event_from,
            'event_to' => $this->budgetRequest->event_to,
            'status_budget_id' => 1,
        ]);

        // Refresh and show message
        $this->emit('success', __('budgets.success_approve'), sprintf(__('budgets.message.approve'), $this->budgetRequest->name));
        $this->emit('hideModal');
        $this->emit('refresh');
    }
}
