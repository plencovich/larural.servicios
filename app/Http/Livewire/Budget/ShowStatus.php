<?php

namespace App\Http\Livewire\Budget;

use App\Models\Budget;
use Livewire\Component;

class ShowStatus extends Component
{
    public $budget;
    public $subZones;

    /**
     * Mount data
     *
     * @return mixed
     */
    public function mount($hash)
    {
        $budget = Budget::findOrFail(decrypt($hash));
        $this->budget = $budget;

        // If budget is not confirmed redirect to details
        if ($this->budget->isConfirmed()) {
            return redirect()->route('budget.customer-view', encrypt($this->budget->id));
        }

        $items = [];
        foreach ($budget->items as $item) {
            $items[$item->subZone->name][] = $item;
        }

        $this->subZones = $items;
    }

    public function render()
    {
        return view('livewire.budget.show-status')->layout('layout_full');
    }
}
