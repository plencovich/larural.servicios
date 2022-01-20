<?php

namespace App\Http\Livewire\Backoffice\Zones;

use App\Models\Zone;
use Livewire\Component;

class Show extends Component
{

    protected $listeners = ['customerShow'];
    public $name;
    public $componentShow;
    public $params;

    public function customerShow($component, ...$params)
    {
        $this->componentShow = $component;
        $this->params = $params;
    }


    public function rules()
    {
        return [
            'name' => ['required', 'unique:zones,name'],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();
        $zone = Zone::create([
            'name' => $this->name,
        ]);
        $this->emit('success', __('zones.zones.alert.create.success'), sprintf(__('zones.zones.alert.create.message'), $this->name));
        $this->reset();
        $this->emit('customerShow', 'backoffice.zones.create-sub-zones', $zone->fresh());
    }

    public function render()
    {
        return view('livewire.backoffice.zones.show');
    }
}
