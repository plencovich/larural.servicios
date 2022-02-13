<?php

namespace App\Http\Livewire\Backoffice\Products;

use Carbon\Carbon;
use Livewire\Component;

class ConsultStock extends Component
{
    public $date_range;
    public $event_from;
    public $event_to;
    protected $queryString = ['event_from', 'event_to'];

    protected $listeners = ['changeDateRange' => 'changeDateRange'];

    /**
     * Consult the date range
     *
     * @return mixed
     */
    public function consult()
    {
        $this->validate();

        $this->emit('refreshQuery', $this->event_from, $this->event_to);

        // Hide modal
        $this->emit('hideModal');
    }

    public function mount()
    {
        $this->changeDateRange(now(), now());
    }

    public function render()
    {
        return view('livewire.backoffice.products.consult-stock');
    }

    /**
     * Change date range
     *
     * @return mixed
     */
    public function changeDateRange($event_from, $event_to)
    {
        $this->event_from = (new Carbon($event_from))->format('Y-m-d');
        $this->event_to = (new Carbon($event_to))->format('Y-m-d');
        $this->date_range = (new Carbon($event_from))->format('d/m/Y') . ' - ' . (new Carbon($event_to))->format('d/m/Y');
    }

    public function rules()
    {
        return [
            'event_from' => ['required', 'date'],
            'event_to' => ['required', 'date'],
        ];
    }
}
