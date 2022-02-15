<?php

namespace App\Http\Livewire\Backoffice\Products;

use App\Models\Category;
use Livewire\Component;

class Categories extends Component
{
    protected $listeners = ['show'];
    public $show = false;
    public $params;


    public function show($component, ...$params)
    {
        $this->show = $component;
        $this->emitTo($component, 'refresh', $params);
    }

    public function render()
    {
        return view('livewire.backoffice.products.categories');
    }
}
