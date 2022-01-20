<?php

namespace App\Http\Livewire\Backoffice\Zones;

use App\Models\Zone;
use Livewire\Component;

class Delete extends Component
{

    public $zone;

    public function mount(Zone $zone)
    {
        $this->zone = $zone;
    }

    public function delete()
    {
        $this->zone->delete();
        $this->emit('success', __('zones.zones.alert.delete.success'), sprintf(__('zones.zones.alert.delete.message'), $this->zone->name));
        $this->emit('hideModal');
        $this->emit('refresh');
    }

    public function render()
    {
        return view('livewire.backoffice.zones.delete');
    }
}
