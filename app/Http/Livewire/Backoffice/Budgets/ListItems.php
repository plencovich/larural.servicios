<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use App\Models\Item;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ListItems extends DataTableComponent
{

    protected $listeners = ['refresh' => 'query'];

    public function columns(): array
    {
        return [
            Column::make('Column Name', 'zone_name'),
            Column::make('Column Name', 'sub_zone_name'),
            Column::make('Column Name', 'product_name'),
            Column::make('Column Name', 'product_qty'),
            Column::make('Column Name', 'product_price'),
        ];
    }

    public function query(): Builder
    {
        return Item::query();
    }
}
