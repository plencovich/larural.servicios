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
            Column::make(__('budgets.name'), 'event_name')->sortable(),
            Column::make(__('budgets.customer'), 'event_from_at')->sortable(),
            Column::make(__('budgets.status'), 'status')->sortable(),
            Column::make(__('budgets.date_from'), 'event_to_at')->sortable(),
            Column::make(__('budgets.date_to'), 'customer.name')->sortable(),
            Column::make(null)->addClass('text-end'),
        ];
    }

    public function rowView(): string
    {
        return 'livewire.backoffice.budgets.row-budgets';
    }

    public function query(): Builder
    {
        return Budget::query()->when(
            $this->getFilter('search'),
            fn ($query, $term) => $query
                ->where('event_name', 'like', '%' . $term . '%')
                ->orWhereHas('customer', fn ($q) => $q->where('name', 'like', '%' . $term . '%')->orWhere('lastname', 'like', '%' . $term . '%'))
        );
    }
}
