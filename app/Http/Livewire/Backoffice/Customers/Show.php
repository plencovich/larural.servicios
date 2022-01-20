<?php

namespace App\Http\Livewire\Backoffice\Customers;

use Livewire\Component;

class Show extends Component
{
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
        return view('livewire.backoffice.customers.show');
    }
}
