<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use App\Models\Budget;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\SubZone;
use App\Models\Zone;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Modal extends Component
{

    public $budget;
    public $zone = 0;
    public $subZone;
    public $productName;
    public $productQty;
    public $productPrice;

    public function mount(Budget $budget)
    {
        $this->budget = $budget;
    }

    public function rules()
    {
        $product = Product::find($this->productName);
        $max = '0';
        if ($product) {
            $max = $product->quantity;
        }

        return [
            'zone' => ['required'],
            'subZone' => ['required'],
            'productName' => ['required', Rule::unique('items', 'product_name')->where(fn($query) => $query->where('budget_id', $this->budget->id))],
            'productQty' => ['required', 'numeric', 'min:0', 'max:' . $max],
            'productPrice' => ['required', 'numeric', 'min:0'],
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
        $prices = ProductPrice::where('product_id', $this->productName)->get();
        $products = Product::all();
        return view('livewire.backoffice.budgets.modal', compact('zones', 'products', 'subZones', 'prices'));
    }
}
