<?php

namespace App\Http\Livewire\Backoffice\Products;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DeleteProduct extends Component
{
    use AuthorizesRequests;

    public $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function delete()
    {
        $this->authorize('delete', $this->product);
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
