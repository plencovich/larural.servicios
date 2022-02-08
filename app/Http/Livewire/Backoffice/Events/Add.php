<?php

namespace App\Http\Livewire\Backoffice\Events;

use Livewire\Component;

class Add extends Component
{
    public $name;
    public $date_range;

    protected $listeners = ['changeDateRange' => 'changeDateRange'];

    public function mount($date_range)
    {
        $this->date_range = $date_range;
    }

    public function render()
    {
        return view('livewire.backoffice.events.add');
    }

    /**
     * Change date range
     *
     * @return mixed
     */
    public function changeDateRange($start, $end)
    {
        dd($start, $end);
    }

    /**
     * Store the event
     *
     * @return mixed
     */
    public function store()
    {
        dd($this->date_range);
    }
}
