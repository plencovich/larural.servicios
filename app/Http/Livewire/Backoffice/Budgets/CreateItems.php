<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Budget;
use Livewire\Component;
use App\Models\Customer;
use App\Models\StatusBudget;
use App\Notifications\BudgetNewNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreateItems extends Component
{
    use AuthorizesRequests;

    public $budget;
    public $event_from;
    public $event_to;
    public $date_range;

    public $fromUrl;

    protected $listeners = ['changeDateRange' => 'changeDateRange', 'updateSelect' => 'updateSelect', 'refreshBudgetTotal' => 'refreshBudgetTotal'];

    public function mount(Budget $budget)
    {
        $this->fromUrl = request()->routeIs('backoffice.budgets.edit', $budget);

        $this->budget = $budget;
        if ($budget->event_from) {
            $this->event_from = $budget->event_from->format('Y-m-d');
        }
        if ($budget->event_to) {
            $this->event_to = $budget->event_to->format('Y-m-d');
        }
        $this->changeDateRange($budget->event_from, $budget->event_to);
    }

    /**
     * Change date range
     *
     * @return mixed
     */
    public function changeDateRange($event_from, $event_to)
    {
        // Get new dates on carbon format
        $new_event_from = (new Carbon($event_from));
        $new_event_to = (new Carbon($event_to));

        // Check if new dates are out of event range and show and alert
        if ($new_event_from < $this->budget->event->event_from || $new_event_to > $this->budget->event->event_to) {
            $this->emit('alert-message', 'warning', __('warning.warning'), __('warning.updating_event_date'));
        }

        // Set new dates
        $this->event_from = $new_event_from->format('Y-m-d');
        $this->event_to = $new_event_to->format('Y-m-d');
        $this->date_range = $new_event_from->format('d/m/Y') . ' - ' . $new_event_to->format('d/m/Y');
    }

    /**
     * Refresh the budget to get the new total
     *
     * @return mixed
     */
    public function refreshBudgetTotal()
    {
        $this->budget = $this->budget->fresh();
    }

    public function rules()
    {
        return [
            'budget.event_id' => ['required'],
            'event_from' => ['required'],
            'event_to' => ['required'],
            'budget.discount' => ['required', 'numeric', 'min:0', 'max:100'],
            'budget.observations' => ['nullable'],
            'budget.customer_id' => ['required'],
        ];
    }

    public function store()
    {
        $this->authorize('update', $this->budget);
        if (!$this->budget->isApproved() && !$this->budget->isRejected()) {
            $this->validate();
            $this->budget->event_from = $this->event_from;
            $this->budget->event_to = $this->event_to;
            $this->budget->status_budget_id = StatusBudget::getSentStatusId();
            $this->budget->save();
            $this->budget->customer->notify(new BudgetNewNotification($this->budget));

            if ($this->fromUrl) {
                return redirect()->route('backoffice.events');
            } else {
                //$this->emit('success', __('budgets.alert.create.success'), sprintf(__('budgets.alert.create.message'), $this->eventName));
                // $this->reset();
                $this->emit('customerShow', false);
            }
        } else {
            $this->emit('alert-message', 'danger', __('budgets.alert.status.cannot-send'), __('budgets.alert.status.cannot-send-message', [
                'budget' => $this->budget->event->name,
                'status' => $this->budget->getStatusAttribute()
            ]));
        }
    }

    public function update()
    {
        $this->authorize('update', $this->budget);
        $this->validate();
        $this->budget->event_from = $this->event_from;
        $this->budget->event_to = $this->event_to;
        $this->budget->save();

        $this->emit('success', __('budgets.alert.updated.saved'), __('budgets.alert.updated.saved-message'));
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

    public function render()
    {
        $this->authorize('view', $this->budget);
        $customers = Customer::all();
        $events = Event::fromNowOn()->get();
        return view('livewire.backoffice.budgets.create-items', compact('customers', 'events'));
    }
}
