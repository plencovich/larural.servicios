<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use App\Models\Budget;
use App\Models\Product;
use App\Models\SubZone;
use App\Models\Zone;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Modal extends Component
{

    public $budget;
    public $zone = 0;
    public $subZone;
    public $productName;
    public $productQty;
    public $productPrice = 0;

    public function mount(Budget $budget)
    {
        $this->budget = $budget;
    }

    public function rules()
    {
        return [
            'zone' => ['required'],
            'subZone' => ['required'],
            'productName' => ['required'],
            'productQty' => ['required'],
            'productPrice' => ['required'],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();
        $this->budget->items()->create([
            'zone_name' => $this->zone,
            'sub_zone_name' => $this->subZone,
            'product_name' => $this->productName,
            'product_qty' => $this->productQty,
            'product_price' => $this->productPrice,
        ]);
        $this->reset(
            'zone',
            'subZone',
            'productName',
            'productQty',
            'productPrice',
        );
        $this->emit('refresh');
    }

    public function render()
    {
        $zones = Zone::all();
        $subZones = SubZone::where('zone_id', $this->zone)->get();
        if (!empty($this->productName)) {
            $this->productPrice = Product::where('id', $this->productName)->first()->price;
        }
        $products = Product::all();
        return view('livewire.backoffice.budgets.modal', compact('zones', 'products', 'subZones'));
    }
}
