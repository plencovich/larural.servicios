<?php

namespace App\Http\Livewire\Backoffice\Products;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductsShow extends Component
{
    use AuthorizesRequests;

    protected $listeners = ['customerShow', 'refreshQuery'];
    public $componentShow;
    public $params;

    public $event_from;
    public $event_to;

    public function mount()
    {
        $this->event_from = request()->has('event_from') ? request()->get('event_from') : null;
        $this->event_to = request()->has('event_to') ? request()->get('event_to') : null;
    }

    public function customerShow($component, ...$params)
    {
        $this->componentShow = $component;
        $this->params = $params;
    }

    public function render()
    {
        $this->authorize('viewAny', Product::class);
        return view('livewire.backoffice.products.products-show');
    }

    public function refreshQuery($event_from, $event_to)
    {
        $this->event_from = $event_from;
        $this->event_to = $event_to;
    }
}
