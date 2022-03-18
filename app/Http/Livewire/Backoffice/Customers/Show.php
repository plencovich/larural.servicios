<?php

namespace App\Http\Livewire\Backoffice\Customers;

use App\Models\Customer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Show extends Component
{
    use AuthorizesRequests;

    protected $listeners = ['customerShow'];
    public $componentShow;
    public $params;

    public function customerShow($component, ...$params)
    {
        $this->componentShow = $component;
        $this->params = $params;
    }

    public function render()
    {
        $this->authorize('viewAny', Customer::class);
        return view('livewire.backoffice.customers.show');
    }
}
