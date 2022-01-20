<?php

namespace App\Http\Livewire\Backoffice\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\StatusOperation;
use App\Models\StatusProduct;
use Livewire\Component;

class CreateProduct extends Component
{
    public $name;
    public $description;
    public $quantity;
    public $price;
    public $category;
    public $statusProduct;
    public $statusOperation;


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
            'price' => ['required', 'numeric'],
            'category' => ['required'],
            'statusProduct' => ['required'],
            'statusOperation' => ['required'],
        ];
    }

    public function store()
    {
        $this->validate();
        Product::create(
            [
                'name' => $this->name,
                'description' => $this->description,
                'image' => '',
                'quantity' => $this->quantity,
                'price' => $this->price,
                'category_id' => $this->category,
                'status_product_id' => $this->statusProduct,
                'status_operation_id' => $this->statusOperation,
            ]
        );
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
