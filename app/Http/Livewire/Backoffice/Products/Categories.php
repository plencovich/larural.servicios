<?php

namespace App\Http\Livewire\Backoffice\Products;

use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Categories extends Component
{
    use AuthorizesRequests;

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
        $this->authorize('viewAny', Category::class);
        return view('livewire.backoffice.products.categories');
    }
}
