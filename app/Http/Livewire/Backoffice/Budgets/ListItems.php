<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use App\Models\Item;
use App\Models\Budget;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class ListItems extends DataTableComponent
{

    protected $listeners = ['refresh' => 'query'];

    public $budget;

    public function mount($budget) {
        $this->budget = $budget;
    }

    public function columns(): array
    {
        return [
            Column::make(__('budgets.zone'), 'zone.name'),
            Column::make(__('budgets.sub-zone'), 'subZone.name'),
            Column::make(__('budgets.product.product'), 'product.name'),
            Column::make(__('budgets.product.quantity'), 'product_qty'),
            Column::make(__('budgets.product.price'), 'product_price'),
        ];
    }

    public function query(): Builder
    {
        return Item::query()->where('budget_id', $this->budget->id)->with(['zone', 'subZone', 'product']);
    }
}
