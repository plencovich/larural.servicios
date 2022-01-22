<?php

namespace App\Http\Livewire\Backoffice\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPriceType;
use App\Models\StatusOperation;
use App\Models\StatusProduct;
use Livewire\Component;

class CreateProduct extends Component
{
    public $name;
    public $description;
    public $quantity;
    public $category;
    public $statusProduct;
    public $statusOperation;
    public $internal_day_a;
    public $internal_day_b;
    public $internal_day_c;
    public $external_day_a;
    public $external_day_b;
    public $external_day_c;


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function rules()
    {
        return [
            'name' => ['required', 'unique:products'],
            'description' => ['required'],
            'quantity' => ['required', 'integer'],
            'internal_day_a' => ['required', 'numeric', 'min:0'],
            'internal_day_b' => ['required', 'numeric', 'min:0'],
            'internal_day_c' => ['required', 'numeric', 'min:0'],
            'external_day_a' => ['required', 'numeric', 'min:0'],
            'external_day_b' => ['required', 'numeric', 'min:0'],
            'external_day_c' => ['required', 'numeric', 'min:0'],
            'category' => ['required'],
            'statusProduct' => ['required'],
            'statusOperation' => ['required'],
        ];
    }

    public function store()
    {
        $this->validate();
        $product = Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'image' => '',
            'quantity' => $this->quantity,
            'category_id' => $this->category,
            'status_product_id' => $this->statusProduct,
            'status_operation_id' => $this->statusOperation,
        ]);

        // Add product prices
        $product->productPrices()->create([
            'day_a' => $this->internal_day_a,
            'day_b' => $this->internal_day_b,
            'day_c' => $this->internal_day_c,
            'product_price_type_id' => ProductPriceType::INTERNAL
        ]);
        $product->productPrices()->create([
            'day_a' => $this->external_day_a,
            'day_b' => $this->external_day_b,
            'day_c' => $this->external_day_c,
            'product_price_type_id' => ProductPriceType::EXTERNAL
        ]);

        $this->emit('success', __('products.products.alert.create.success'), sprintf(__('products.products.alert.create.message'), $this->name));
        $this->reset();
    }

    public function render()
    {
        $categories = Category::all();
        $statusProducts = StatusProduct::all();
        $statusOperations = StatusOperation::all();
        return view('livewire.backoffice.products.create-product', compact('categories', 'statusProducts', 'statusOperations'));
    }
}
