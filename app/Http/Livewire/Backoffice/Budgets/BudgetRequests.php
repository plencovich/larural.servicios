<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\BudgetRequest;

class BudgetRequests extends DataTableComponent
{
    protected $listeners = ['refresh' => 'query'];

    public function columns(): array
    {
        return [
            Column::make(__('budgets.event'), 'event_name')->sortable(),
            Column::make(__('events.user'), 'event_from_at')->sortable(),
            Column::make(__('budgets.date_from'), 'event_to_at')->sortable(),
            Column::make(__('budgets.date_to'), 'user.name')->sortable(),
            Column::make(__('budgets.status'), 'status')->sortable(),
            Column::make(null)->addClass('text-end'),
        ];
    }

    public function query(): Builder
    {
        return BudgetRequest::query()
            ->when(
                $this->getFilter('search'),
                fn ($query, $term) => $query
                    ->whereHas('event', fn ($q) => $q->where('name', 'like', '%' . $term . '%'))
                    ->orWhereHas('user', fn ($q) => $q->where('name', 'like', '%' . $term . '%')->orWhere('lastname', 'like', '%' . $term . '%'))
            )
            ->when(
                auth()->user()->hasRole('Comercial 1'),
                fn ($query) => $query
                    ->where('customer_id', auth()->id())
            );
    }

    public function rowView(): string
    {
        return 'livewire.backoffice.budgets.budget-requests';
    }
}
