<?php

namespace App\Http\Livewire\Backoffice\Customers;

use App\Models\Customer;
use Livewire\Component;

class Edit extends Component
{

    public $customer;

    public function mount(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function rules()
    {
        return [
            'customer.code' => ['required', 'unique:customers,code,' . $this->customer->id],
            'customer.business_name' => ['required', 'unique:customers,business_name,' . $this->customer->id],
            'customer.name' => ['required'],
            'customer.lastname' => ['required'],
            'customer.email' => ['email:dns', 'unique:customers,email,' . $this->customer->id],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function store()
    {
        $this->validate();
        $this->customer->save();
        $this->emit('success', __('customers.success_edit'), sprintf(__('customers.message_edit'), $this->customer->business_name));
        $this->reset();
        $this->emit('customerShow', false);
    }

    public function render()
    {
        return view('livewire.backoffice.customers.edit');
    }
}
