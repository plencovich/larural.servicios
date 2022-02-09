<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Budget;
use Livewire\Component;
use App\Models\Customer;
use App\Notifications\BudgetNewNotification;

class CreateItems extends Component
{

    public $budget;
    public $event_from;
    public $event_to;
    public $date_range;

    public $fromUrl;

    protected $listeners = ['changeDateRange' => 'changeDateRange'];

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

    public function rules()
    {
        return [
            'budget.event_id' => ['required', 'unique:budgets,' . $this->budget->id],
            'event_from' => ['required', 'unique:budgets,event_from,' . $this->budget->id],
            'event_to' => ['required', 'unique:budgets,event_from,' . $this->budget->id],
            'budget.discount' => ['required', 'integer'],
            'budget.observations' => ['required'],
            'budget.customer_id' => ['required'],
        ];
    }

    public function store()
    {
        $this->validate();
        $this->budget->event_from = $this->event_from;
        $this->budget->event_to = $this->event_to;
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
        $events = Event::fromNowOn()->get();
        return view('livewire.backoffice.budgets.create-items', compact('customers', 'events'));
    }
}
