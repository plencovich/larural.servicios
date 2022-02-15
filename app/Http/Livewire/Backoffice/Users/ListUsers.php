<?php

namespace App\Http\Livewire\Backoffice\Users;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class ListUsers extends DataTableComponent
{

    protected $listeners = ['refresh' => 'query'];

    public function columns(): array
    {
        return [
            Column::make(__('users.name'), 'name')->sortable(),
            Column::make(__('users.lastname'), 'lastname')->sortable(),
            Column::make(__('users.email'), 'email')->sortable(),
            Column::make(__('users.created_at'), 'created_at')->sortable(),
            Column::make(__('users.account_verified_at'), 'account_verified_at')->sortable(),
            Column::make(__('users.role')),
            Column::make(null)->addClass('text-end'),
        ];
    }

    public function rowView(): string
    {
        return 'livewire.backoffice.users.row';
    }

    public function query(): Builder
    {
        return User::query()
            ->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%' . $term . '%')
                ->orWhere('lastname', 'like', '%' . $term . '%')
                ->orWhere('email', 'like', '%' . $term . '%'));
    }
}
