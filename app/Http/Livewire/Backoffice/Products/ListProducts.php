<?php

namespace App\Http\Livewire\Backoffice\Products;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Product;

class ListProducts extends DataTableComponent
{

    protected $listeners = ['refresh' => 'query', 'refreshQuery' => 'refreshData'];
    public $event_from;
    public $event_to;

    public function mount()
    {
        $this->event_from = request()->has('event_from') ? request()->get('event_from') : now();
        $this->event_to = request()->has('event_to') ? request()->get('event_to') : now();
    }

    public function columns(): array
    {
        return [
            Column::make(__('products.products.image'), 'image'),
            Column::make(__('products.products.code'), 'code')->sortable(),
            Column::make(__('products.products.name'), 'name')->sortable(),
            Column::make(__('products.products.description'), 'description')->sortable(),
            Column::make(__('products.products.quantity'), 'quantity')->sortable(),
            Column::make(__('products.products.stock'), 'quantity')->sortable(),
            Column::make(__('products.products.category'), 'category_id')->sortable(),
            Column::make(__('products.products.status-product'), 'status_product_id')->sortable(),
            Column::make(__('products.products.status-operation'), 'status_operation_id')->sortable(),
            Column::make(null)->addClass('text-end'),
        ];
    }

    public function refreshData($event_from, $event_to)
    {
        $this->event_from = $event_from;
        $this->event_to = $event_to;

        $this->resetPage();
    }

    public function rowView(): string
    {
        return 'livewire.backoffice.products.row-products';
    }

    public function query(): Builder
    {
        return Product::query()->when($this->getFilter('search'), fn ($query, $term) => $query
            ->where('code', 'like', '%' . $term . '%')
            ->where('name', 'like', '%' . $term . '%')
            ->orWhere('description', 'like', '%' . $term . '%')
            ->orWhere('quantity', 'like', '%' . $term . '%'));
    }
}
