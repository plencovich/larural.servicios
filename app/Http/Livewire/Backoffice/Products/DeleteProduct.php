<?php

namespace App\Http\Livewire\Backoffice\Products;

use App\Models\Product;
use Livewire\Component;

class DeleteProduct extends Component
{

    public $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function delete()
    {
        $this->product->delete();
        $this->emit('success', __('products.products.alert.delete.success'), sprintf(__('products.categories.alert.delete.message'), $this->product->name));
        $this->emit('hideModal');
        $this->emit('refresh');
    }

    public function render()
    {
        return view('livewire.backoffice.products.delete-product');
    }
}
