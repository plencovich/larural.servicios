<?php

namespace App\Http\Livewire\Backoffice\Customers;

use App\Models\Customer;
use Livewire\Component;

class Create extends Component
{


    public $businessName;
    public $name;
    public $lastname;
    public $email;

    public function rules()
    {
        return [
            'businessName' => ['required', 'unique:customers,business_name'],
            'name' => ['required'],
            'lastname' => ['required'],
            'email' => ['email:dns', 'unique:customers,email'],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();
        Customer::create([
            'business_name' => $this->businessName,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'email' => $this->email,
        ]);
        $this->emit('success', __('customers.success_create'), sprintf(__('customers.message_create'), $this->businessName));
        $this->reset();
        $this->emit('customerShow', false);
    }

    public function render()
    {
        return view('livewire.backoffice.customers.create');
    }
}
