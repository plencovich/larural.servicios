<?php

namespace App\Http\Livewire\Backoffice\Events;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\EventRequest;

class ListRequests extends DataTableComponent
{
    protected $listeners = ['refresh' => 'query'];

    public function columns(): array
    {
        return [
            Column::make(__('budgets.event'), 'name')->sortable(),
            Column::make(__('events.user'), 'customer.name')->sortable(),
            Column::make(__('budgets.date_from'), 'event_from_at')->sortable(),
            Column::make(__('budgets.date_to'), 'event_to_at')->sortable(),
            Column::make(__('budgets.status'), 'status')->sortable(),
            Column::make(null)->addClass('text-end'),
        ];
    }

    public function query(): Builder
    {
        return EventRequest::query()
            ->when(
                $this->getFilter('search'),
                fn ($query, $term) => $query
                    ->where('name', 'like', '%' . $term . '%')
                    ->orWhereHas('user', fn ($q) => $q->where('name', 'like', '%' . $term . '%')->orWhere('lastname', 'like', '%' . $term . '%'))
            )
            ->when(
                auth()->user()->hasRole('Comercial 1'),
                fn ($query) => $query
                    ->where('user_id', auth()->id())
            );
    }

    public function rowView(): string
    {
        return 'livewire.backoffice.events.list-requests';
    }
}
