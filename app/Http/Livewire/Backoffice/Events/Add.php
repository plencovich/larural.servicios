<?php

namespace App\Http\Livewire\Backoffice\Events;

use Livewire\Component;

class Add extends Component
{
    public $name;
    public $from_date;
    public $to_date;

    public function mount($from_date)
    {
        $this->from_date = $from_date;
    }

    public function render()
    {
        return view('livewire.backoffice.events.add');
    }
}
