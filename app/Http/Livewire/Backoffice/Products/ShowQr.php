<?php

namespace App\Http\Livewire\Backoffice\Products;

use App\Models\Product;
use Livewire\Component;

class ShowQr extends Component
{
    public $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.backoffice.products.show-qr');
    }
}
