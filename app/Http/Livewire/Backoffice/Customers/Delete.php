<?php

namespace App\Http\Livewire\Backoffice\Customers;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Delete extends Component
{
    use AuthorizesRequests;

    public $customer;

    public function mount(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function delete()
    {
        $this->authorize('delete', $this->customer);
        $this->customer->delete();
        $this->emit('success', __('customers.success_delete'), sprintf(__('customers.message_delete'), $this->customer->business_name));
        $this->emit('hideModal');
        $this->emit('refresh');
    }

    public function render()
    {
        return view('livewire.backoffice.customers.delete');
    }
}
