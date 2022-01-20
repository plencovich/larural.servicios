<?php

namespace App\Http\Livewire\Backoffice\Products;

use Livewire\Component;

class ProductsShow extends Component
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
        return view('livewire.backoffice.products.products-show');
    }
}
