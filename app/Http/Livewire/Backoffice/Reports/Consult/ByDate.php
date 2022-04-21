<?php

namespace App\Http\Livewire\Backoffice\Reports\Consult;

use Carbon\Carbon;
use Livewire\Component;

class ByDate extends Component
{
    public $date_range;
    public $from_date;
    public $to_date;
    protected $queryString = ['from_date', 'to_date'];

    protected $listeners = ['changeDateRange' => 'changeDateRange'];

    /**
     * Consult the date range
     *
     * @return mixed
     */
    public function consult()
    {
        $this->validate();

        $this->emit('refreshQuery', $this->from_date, $this->to_date);

        // Hide modal
        $this->emit('hideModal');
    }

    public function mount()
    {
        $this->changeDateRange(now(), now());
    }

    public function render()
    {
        return view('livewire.backoffice.reports.consult.by-date');
    }

    /**
     * Change date range
     *
     * @return mixed
     */
    public function changeDateRange($from_date, $to_date)
    {
        $this->from_date = (new Carbon($from_date))->format('Y-m-d');
        $this->to_date = (new Carbon($to_date))->format('Y-m-d');
        $this->date_range = (new Carbon($from_date))->format('d/m/Y') . ' - ' . (new Carbon($to_date))->format('d/m/Y');
    }

    public function rules()
    {
        return [
            'from_date' => ['required', 'date'],
            'to_date' => ['required', 'date'],
        ];
    }
}
