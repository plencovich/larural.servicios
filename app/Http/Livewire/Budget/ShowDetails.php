<?php

namespace App\Http\Livewire\Budget;

use App\Models\Budget;
use App\Models\StatusBudget;
use App\Notifications\BudgetNewStatusNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class ShowDetails extends Component
{
    public $budget;
    public $subZones;

    /**
     * Mount data
     *
     * @return mixed
     */
    public function mount($hash)
    {
        $budget = Budget::findOrFail(decrypt($hash));
        $this->budget = $budget;

        // If budget is not confirmed redirect to status
        if ($this->budget->isApproved() || $this->budget->isRejected()) {
            return redirect()->route('budget.customer-status', encrypt($this->budget->id));
        }

        $items = [];
        foreach ($budget->items as $item) {
            $items[$item->subZone->name][] = $item;
        }

        $this->subZones = $items;
    }

    public function render()
    {
        return view('livewire.budget.show-details')->layout('layout_full');
    }

    /**
     * Approve the budget
     *
     * @return mixed
     */
    public function approve()
    {
        if ($this->budget->isSent()) {
            $this->budget->update([
                'status_budget_id' => StatusBudget::getApprovedStatusId()
            ]);
            $this->emit('success', __('budgets.alert.status.approved'), sprintf(__('budgets.alert.status.approved-message'), $this->budget->event_name));

            // Send email to admins
            Notification::route('mail', 'admin1@larural.com')->notify(new BudgetNewStatusNotification($this->budget->fresh()));
        } else {
            $this->emit('success', __('budgets.alert.status.unauthorized'), __('budgets.alert.status.unauthorized'));
        }

        return redirect()->route('budget.customer-status', encrypt($this->budget->id));
    }

    /**
     * Reject the budget
     *
     * @return mixed
     */
    public function reject()
    {
        if ($this->budget->isSent()) {
            $this->budget->update([
                'status_budget_id' => StatusBudget::getRejectedStatusId()
            ]);
            $this->emit('success', __('budgets.alert.status.rejected'), sprintf(__('budgets.alert.status.rejected-message'), $this->budget->event_name));

            // Send email to admins
            Notification::route('mail', 'admin1@larural.com')->notify(new BudgetNewStatusNotification($this->budget->fresh()));
        } else {
            $this->emit('success', __('budgets.alert.status.unauthorized'), __('budgets.alert.status.unauthorized'));
        }

        return redirect()->route('budget.customer-status', encrypt($this->budget->id));
    }
}
