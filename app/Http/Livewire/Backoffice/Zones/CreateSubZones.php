<?php

namespace App\Http\Livewire\Backoffice\Zones;

use App\Models\SubZone;
use App\Models\Zone;
use Livewire\Component;

class CreateSubZones extends Component
{

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
