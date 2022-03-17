<?php

namespace App\Http\Livewire\Backoffice\Zones;

use App\Models\SubZone;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ListSubZones extends DataTableComponent
{
    protected $listeners = ['refresh' => 'query'];
    public $zoneId;

    public function columns(): array
    {
        return [
            Column::make(__('zones.sub-zones.sub-zones'), 'name')->sortable(),
            Column::make(null)->addClass('text-end'),
        ];
    }

    public function rowView(): string
    {
        return 'livewire.backoffice.zones.row-sub-zones';
    }

    public function query(): Builder
    {
        return SubZone::query()->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%' . $term . '%'))->where('zone_id', $this->zoneId);
    }
}
