<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use App\Models\Budget;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ListBudgets extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make(__('budgets.name'), 'event_name'),
            Column::make(__('budgets.date'), 'event_at'),
            Column::make(null)->addClass('text-end'),
        ];
    }

    public function rowView(): string
    {
        return 'livewire.backoffice.budgets.row-budgets';
    }

    public function query(): Builder
    {
        return Budget::query();
    }
}
