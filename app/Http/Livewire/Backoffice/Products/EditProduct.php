<?php

namespace App\Http\Livewire\Backoffice\Products;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\StatusProduct;
use Livewire\WithFileUploads;
use App\Models\StatusOperation;
use App\Models\ProductPriceType;

class EditProduct extends Component
{
    use WithFileUploads;

    public $product;
    public $image;
    public $internal_day_a = 0;
    public $internal_day_b = 0;
    public $internal_day_c = 0;
    public $internal_day_d = 0;
    public $external_day_a = 0;
    public $external_day_b = 0;
    public $external_day_c = 0;
    public $external_day_d = 0;

    public $fromUrl;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->fromUrl = request()->routeIs('backoffice.products.edit', $product);

        // Get prices
        if (filled($product->productPrices->where('product_price_type_id', ProductPriceType::INTERNAL))) {
            $this->internal_day_a = $product->productPrices->where('product_price_type_id', ProductPriceType::INTERNAL)->first()->day_a;
            $this->internal_day_b = $product->productPrices->where('product_price_type_id', ProductPriceType::INTERNAL)->first()->day_b;
            $this->internal_day_c = $product->productPrices->where('product_price_type_id', ProductPriceType::INTERNAL)->first()->day_c;
            $this->internal_day_d = $product->productPrices->where('product_price_type_id', ProductPriceType::INTERNAL)->first()->day_d;
        }

        if (filled($product->productPrices->where('product_price_type_id', ProductPriceType::EXTERNAL))) {
            $this->external_day_a = $product->productPrices->where('product_price_type_id', ProductPriceType::EXTERNAL)->first()->day_a;
            $this->external_day_b = $product->productPrices->where('product_price_type_id', ProductPriceType::EXTERNAL)->first()->day_b;
            $this->external_day_c = $product->productPrices->where('product_price_type_id', ProductPriceType::EXTERNAL)->first()->day_c;
            $this->external_day_d = $product->productPrices->where('product_price_type_id', ProductPriceType::EXTERNAL)->first()->day_d;
        }
    }

    public function rules()
    {

        return [
            'product.code' => ['required', 'unique:products,code,' . $this->product->id],
            'product.name' => ['required', 'unique:products,name,' . $this->product->id],
            'product.description' => ['required'],
            'product.quantity' => ['required', 'integer'],
            'internal_day_a' => ['required', 'numeric', 'min:0'],
            'internal_day_b' => ['required', 'numeric', 'min:0'],
            'internal_day_c' => ['required', 'numeric', 'min:0'],
            'internal_day_d' => ['required', 'numeric', 'min:0'],
            'external_day_a' => ['required', 'numeric', 'min:0'],
            'external_day_b' => ['required', 'numeric', 'min:0'],
            'external_day_c' => ['required', 'numeric', 'min:0'],
            'external_day_d' => ['required', 'numeric', 'min:0'],
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

        // Store image
        if ($this->image) {
            $this->product->update([
                'image' => $this->image->store('products', 'public')
            ]);
        }

        // Save prices
        if (filled($this->product->productPrices()->where('product_price_type_id', ProductPriceType::INTERNAL))) {
            $this->product->productPrices()->where('product_price_type_id', ProductPriceType::INTERNAL)->update([
                'day_a' => $this->internal_day_a,
                'day_b' => $this->internal_day_b,
                'day_c' => $this->internal_day_c,
                'day_d' => $this->internal_day_d,
            ]);
        }
        if (filled($this->product->productPrices()->where('product_price_type_id', ProductPriceType::EXTERNAL))) {
            $this->product->productPrices()->where('product_price_type_id', ProductPriceType::EXTERNAL)->update([
                'day_a' => $this->external_day_a,
                'day_b' => $this->external_day_b,
                'day_c' => $this->external_day_c,
                'day_d' => $this->external_day_d,
            ]);
        }

        if ($this->fromUrl) {
            return redirect()->route('backoffice.products.list');
        } else {
            $this->emit('success', __('products.products.alert.edit.success'), sprintf(__('products.products.alert.edit.message'), $this->product->name));
            $this->reset();
            $this->emit('customerShow', false);
        }
    }


    public function render()
    {
        $categories = Category::all();
        $statusProducts = StatusProduct::all();
        $statusOperations = StatusOperation::all();
        $fromUrl = $this->fromUrl;
        return view('livewire.backoffice.products.edit-product', compact('categories', 'statusProducts', 'statusOperations', 'fromUrl'));
    }
}
