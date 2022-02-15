<?php

namespace App\Http\Livewire\Backoffice\Products;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Category;

class ListCategories extends DataTableComponent
{

    protected $listeners = ['refresh' => 'query'];

    public function columns(): array
    {
        return [
            Column::make('Nombre', 'name')->sortable(),
            Column::make(null)->addClass('text-end'),
        ];
    }

    public function rowView(): string
    {
        return 'livewire.backoffice.products.row-categories';
    }

    public function query(): Builder
    {
        return Category::query()->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%' . $term . '%'));
    }
}
