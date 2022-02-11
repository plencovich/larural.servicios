<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use App\Models\Budget;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\SubZone;
use App\Models\Zone;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Modal extends Component
{

    public $budget;
    public $zone = '';
    public $subZone = '';
    public $product_id = '';
    public $productQty;
    public $productPrice = '';
    public $discount = 0;

    protected $listeners = ['updateSelect' => 'updateSelect'];

    public function mount(Budget $budget)
    {
        $this->budget = $budget;
    }

    public function rules()
    {
        $product = Product::find($this->product_id);
        $max = '0';
        if ($product) {
            $max = $product->quantity;
            // $max = $product->availableStockForDateRange($this->budget->event_from, $this->budget->event_to);
        }

        $this->emit('resetSelect2');

        return [
            'zone' => ['required'],
            'subZone' => ['required'],
            'product_id' => ['required', Rule::unique('items')->where(fn ($query) => $query->where('budget_id', $this->budget->id))],
            'productQty' => ['required', 'numeric', 'min:0', 'max:' . $max],
            'productPrice' => ['required', 'numeric', 'min:0'],
            'discount' => ['required', 'numeric', 'min:0', 'max:100'],
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
            'product_id' => $this->product_id,
            'product_qty' => $this->productQty,
            'product_price' => $this->productPrice,
            'discount' => $this->discount,
        ]);
        $this->reset(
            'zone',
            'subZone',
            'product_id',
            'productQty',
            'productPrice',
            'discount',
        );
        $this->emit('refresh');
        $this->emit('refreshBudgetTotal');
        $this->emit('resetSelect2');
    }

    public function render()
    {
        $zones = Zone::all();
        $subZones = SubZone::where('zone_id', $this->zone)->get();
        $prices = ProductPrice::where('product_id', $this->product_id)->get();

        // Only products for rent
        $products = Product::forRent()
            ->whereDoesntHave('productReservations', fn ($q) => $q->where('budget_id', $this->budget->id))
            ->get();
        return view('livewire.backoffice.budgets.modal', compact('zones', 'products', 'subZones', 'prices'));
    }

    /**
     * Update select 2 model
     *
     * @return mixed
     */
    public function updateSelect($property, $value)
    {
        $this->$property = $value;
        $this->emit('resetSelect2');
    }
}
