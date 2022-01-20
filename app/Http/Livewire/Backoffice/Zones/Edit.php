<?php

namespace App\Http\Livewire\Backoffice\Zones;

use App\Models\Zone;
use Livewire\Component;

class Edit extends Component
{

    public $zone;

    public function mount(Zone $zone)
    {
        $this->zone = $zone;
    }

    public function rules()
    {
        return [
            'zone.name' => ['required', 'unique:zones,name,' . $this->zone->id],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();
        $this->zone->save();
        $this->emit('success', __('zones.zones.alert.edit.success'), sprintf(__('zones.zones.alert.edit.message'), $this->zone->name));
        $this->emit('refresh');
        $this->emit('hideModal');
    }


    public function render()
    {
        return view('livewire.backoffice.zones.edit');
    }
}
