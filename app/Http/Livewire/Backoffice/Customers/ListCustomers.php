<?php

namespace App\Http\Livewire\Backoffice\Customers;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Customer;

class ListCustomers extends DataTableComponent
{

    protected $listeners = ['refresh' => 'query'];

    public function columns(): array
    {
        return [
            Column::make(__('customers.business_name'), 'business_name')->sortable(),
            Column::make(__('customers.email'), 'email')->sortable(),
            Column::make(__('customers.lastname'), 'lastname')->sortable(),
            Column::make(__('customers.name'), 'name')->sortable(),
            Column::make(null)->addClass('text-end'),
        ];
    }

    public function rowView(): string
    {
        return 'livewire.backoffice.customers.row';
    }

    public function query(): Builder
    {
        return Customer::query()
            ->when($this->getFilter('search'), fn ($query, $term) => $query->where('business_name', 'like', '%' . $term . '%')
                ->orWhere('name', 'like', '%' . $term . '%')
                ->orWhere('lastname', 'like', '%' . $term . '%')
                ->orWhere('email', 'like', '%' . $term . '%'));
    }
}
