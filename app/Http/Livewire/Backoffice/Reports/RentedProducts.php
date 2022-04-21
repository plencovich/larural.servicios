<?php

namespace App\Http\Livewire\Backoffice\Reports;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RentedProducts extends Component
{
    use AuthorizesRequests;

    protected $listeners = ['customerShow', 'refreshQuery'];
    public $componentShow;
    public $params;

    public $from_date;
    public $to_date;

    public function mount()
    {
        $this->from_date = request()->has('from_date') ? request()->get('from_date') : null;
        $this->to_date = request()->has('to_date') ? request()->get('to_date') : null;
    }

    public function customerShow($component, ...$params)
    {
        $this->componentShow = $component;
        $this->params = $params;
    }

    public function render()
    {
        // $this->authorize('viewAny', Product::class);
        return view('livewire.backoffice.reports.rented-products');
    }


    public function refreshQuery($from_date, $to_date)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }
}
