<?php

namespace App\Http\Livewire\Backoffice\Zones;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Zone;

class ListZones extends DataTableComponent
{

    protected $listeners = ['refresh' => 'query'];

    public function columns(): array
    {
        return [
            Column::make(__('zones.zones.zones'), 'name')->sortable(),
            Column::make(null)->addClass('text-end'),
        ];
    }

    public function rowView(): string
    {
        return 'livewire.backoffice.zones.row-zones';
    }

    public function query(): Builder
    {
        return Zone::query()->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%' . $term . '%'));
    }
}
