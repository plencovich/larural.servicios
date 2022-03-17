<?php

namespace App\Http\Livewire\Backoffice\Zones;

use App\Models\Zone;
use App\Models\SubZone;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreateSubZones extends Component
{
    use AuthorizesRequests;

    public $name;

    public $zone;

    public function mount(Zone $zone)
    {
        $this->zone = $zone;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'unique:sub_zones,name'],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->authorize('create', Zone::class);
        $this->validate();
        $this->zone->subZones()->create(
            [
                'name' => $this->name
            ]
        );
        $this->emit('success', __('zones.sub-zones.alert.create.success'), sprintf(__('zones.sub-zones.alert.create.message'), $this->name));
        $this->reset('name');
        $this->emit('refresh');
    }
    public function render()
    {
        return view('livewire.backoffice.zones.create-sub-zones');
    }
}
