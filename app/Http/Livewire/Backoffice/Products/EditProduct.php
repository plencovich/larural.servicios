<?php

namespace App\Http\Livewire\Backoffice\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\StatusOperation;
use App\Models\StatusProduct;
use Livewire\Component;

class EditProduct extends Component
{

    public $product;

    public function mount(Product $product)

    {
        $this->product = $product;
    }

    public function rules()
    {

        return [
            'product.name' => ['required', 'unique:products,name,' . $this->product->id],
            'product.description' => ['required'],
            'product.quantity' => ['required', 'integer'],
            'product.price' => ['required', 'numeric'],
            'product.category_id' => ['required'],
            'product.status_product_id' => ['required'],
            'product.status_operation_id' => ['required'],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function store()
    {
        $this->validate();
        $this->product->save();
        $this->emit('success', __('products.products.alert.edit.success'), sprintf(__('products.products.alert.edit.message'), $this->product->name));
        $this->reset();
        $this->emit('customerShow', false);
    }


    public function render()
    {
        $categories = Category::all();
        $statusProducts = StatusProduct::all();
        $statusOperations = StatusOperation::all();
        return view('livewire.backoffice.products.edit-product', compact('categories', 'statusProducts', 'statusOperations'));
    }
}
