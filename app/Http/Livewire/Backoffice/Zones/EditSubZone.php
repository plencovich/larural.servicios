<?php

namespace App\Http\Livewire\Backoffice\Zones;

use App\Models\SubZone;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EditSubZone extends Component
{
    use AuthorizesRequests;

    public $subZone;

    public function mount(SubZone $subZone)
    {
        $this->subZone = $subZone;
    }

    public function rules()
    {
        return [
            'subZone.name' => ['required', 'unique:sub_zones,name,' . $this->subZone->id],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->authorize('update', $this->subZone->singleZone);
        $this->validate();
        $this->subZone->save();
        $this->emit('success', __('zones.sub-zones.alert.edit.success'), sprintf(__('zones.sub-zones.alert.edit.message'), $this->subZone->name));
        $this->emit('refresh');
        $this->emit('hideModal');
    }

    public function render()
    {
        return view('livewire.backoffice.zones.edit-sub-zone');
    }
}
