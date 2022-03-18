<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use App\Models\Budget;
use App\Models\BudgetRequest;
use App\Models\Customer;
use App\Models\Event;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public $customer_id;
    public $event_id;

    protected $listeners = ['updateSelect' => 'updateSelect'];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function rules()
    {
        return [
            'customer_id' => ['required'],
            'event_id' => ['required'],
        ];
    }

    public function store()
    {
        $this->authorize('create', Budget::class);

        $this->validate();

        // Get event
        $event = Event::findOrFail($this->event_id);

        // Get budget data
        $data = [
            'customer_id' => $this->customer_id,
            'event_id' => $this->event_id,
            'event_from' => $event->event_from,
            'event_to' => $event->event_to,
        ];

        // If user is "Comercial 1" then just send a request to create the event. The Admin will have to approve it
        if (auth()->user()->hasRole(['Comercial 1'])) {
            $budgetRequest = BudgetRequest::create($data);

            // Emit message if success
            $this->emit('success', __('budgets.alert.request.success'), sprintf(__('budgets.alert.request.message'), $budgetRequest->event->name));
            $this->reset();
            $this->emit('hideModal');
        } else {
            // Create event
            $budget = Budget::create(array_merge($data, [
                'status_budget_id' => 1,
            ]));

            //$this->emit('success', __('budgets.alert.create.success'), sprintf(__('budgets.alert.create.message'), $this->event_id));
            $this->reset();
            $this->emit('hideModal');
            $this->emit('customerShow', 'backoffice.budgets.create-items', $budget->fresh());
        }
    }

    public function render()
    {
        // Role "Comercial 1" can only create request for their own
        if (auth()->user()->hasRole('Comercial 1')) {
            $customers = collect([auth()->user()]);
            $events = Event::fromNowOn()->whereIn('name', auth()->user()->eventRequests->pluck('name'))->get();
        } else {
            $customers = Customer::all();
            $events = Event::fromNowOn()->get();
        }
        return view('livewire.backoffice.budgets.create', compact('customers', 'events'));
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
}
