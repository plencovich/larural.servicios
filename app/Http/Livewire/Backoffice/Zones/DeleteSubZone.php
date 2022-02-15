<?php

namespace App\Http\Livewire\Backoffice\Zones;

use App\Models\SubZone;
use Livewire\Component;

class DeleteSubZone extends Component
{

    public $subZone;

    public function mount(SubZone $subZone)
    {
        $this->subZone = $subZone;
    }

    public function delete()
    {
        $this->subZone->delete();
        $this->emit('success', __('zones.sub-zones.alert.delete.success'), sprintf(__('zones.sub-zones.alert.delete.message'), $this->subZone->name));
        $this->emit('hideModal');
        $this->emit('refresh');
    }

    public function render()
    {
        return view('livewire.backoffice.zones.delete-sub-zone');
    }
}
