<?php

namespace App\Http\Livewire\Backoffice\Reports;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Product;
use App\Models\StatusBudget;

class ListRentedProducts extends DataTableComponent
{
    protected $listeners = ['refresh' => 'query', 'refreshQuery' => 'refreshData'];
    public $from_date;
    public $to_date;

    public function mount()
    {
        $this->from_date = request()->has('from_date') ? request()->get('from_date') : null;
        $this->to_date = request()->has('to_date') ? request()->get('to_date') : null;
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
            Column::make(__('products.products.zones'), 'quantity')->sortable(),
            Column::make(__('reports.products.events'), 'quantity')->sortable(),
        ];
    }

    public function refreshData($from_date, $to_date)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;

        $this->resetPage();
    }

    public function rowView(): string
    {
        return 'livewire.backoffice.reports.row-rented-products';
    }

    public function query(): Builder
    {
        return Product::query()
            ->with(['productReservations.zone', 'productReservations.budget.event'])
            ->rented()
            ->when(
                $this->from_date,
                fn ($query) => $query->whereHas(
                    'productReservations',
                    fn ($query) => $query->whereHas(
                        'budget',
                        fn ($budgetQuery) => $budgetQuery->where(
                            fn ($innerBudgetQuery) => $innerBudgetQuery->whereBetween('event_from', [$this->from_date, $this->to_date])
                                ->orWhereBetween('event_to', [$this->from_date, $this->to_date])
                        )
                    )
                )
            )
            ->when(
                $this->getFilter('search'),
                fn ($query, $term) => $query
                    ->where('code', 'like', '%' . $term . '%')
                    ->orWhere('name', 'like', '%' . $term . '%')
                    ->orWhere('description', 'like', '%' . $term . '%')
                    ->orWhere('quantity', 'like', '%' . $term . '%')
                    ->orWhereHas('productReservations', fn ($query) => $query->whereHas('zone', fn ($zoneQuery) => $zoneQuery->where('name', 'like', '%' . $term . '%')))
                    ->orWhereHas('productReservations', fn ($query) => $query->whereHas('budget', fn ($budgetQuery) => $budgetQuery->whereHas('event', fn ($eventQuery) => $eventQuery->where('name', $term))))
            );
    }
}
