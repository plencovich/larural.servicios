<?php

namespace App\Http\Livewire\Backoffice\Products;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Product;

class ListProducts extends DataTableComponent
{

    protected $listeners = ['refresh' => 'query'];

    public function columns(): array
    {
        return [
            Column::make(__('products.products.name'), 'name')->sortable(),
            Column::make(__('products.products.description'), 'description')->sortable(),
            Column::make(__('products.products.quantity'), 'quantity')->sortable(),
            Column::make(__('products.products.price'), 'price')->sortable(),
            Column::make(__('products.products.category'), 'category_id')->sortable(),
            Column::make(__('products.products.status-product'), 'status_product_id')->sortable(),
            Column::make(__('products.products.status-operation'), 'status_operation_id')->sortable(),
            Column::make(null)->addClass('text-end'),
        ];
    }

    public function rowView(): string
    {
        return 'livewire.backoffice.products.row-products';
    }

    public function query(): Builder
    {
        return Product::query()->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%' . $term . '%')
            ->orWhere('description', 'like', '%' . $term . '%')
            ->orWhere('quantity', 'like', '%' . $term . '%')
            ->orWhere('price', 'like', '%' . $term . '%'));
    }
}
