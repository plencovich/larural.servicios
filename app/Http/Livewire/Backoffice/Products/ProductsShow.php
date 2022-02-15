<?php

namespace App\Http\Livewire\Backoffice\Products;

use Livewire\Component;

class ProductsShow extends Component
{
    protected $listeners = ['customerShow'];
    public $componentShow;
    public $params;

    public $event_from;
    public $event_to;

    public function mount()
    {
        $this->event_from = request()->has('event_from') ? request()->get('event_from') : now();
        $this->event_to = request()->has('event_to') ? request()->get('event_to') : now();
    }

    public function customerShow($component, ...$params)
    {
        $this->componentShow = $component;
        $this->params = $params;
    }

    public function render()
    {
        return view('livewire.backoffice.products.products-show');
    }
}
