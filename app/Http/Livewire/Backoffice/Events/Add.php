<?php

namespace App\Http\Livewire\Backoffice\Events;

use App\Helpers\Helper;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Add extends Component
{
    use AuthorizesRequests;

    public $name;
    public $date_range;
    public $event_from;
    public $event_to;

    protected $listeners = ['changeDateRange' => 'changeDateRange'];

    public function mount($date_range)
    {
        $this->changeDateRange($date_range, $date_range);
    }

    public function render()
    {
        $this->authorize('create', Event::class);
        return view('livewire.backoffice.events.add');
    }

    /**
     * Change date range
     *
     * @return mixed
     */
    public function changeDateRange($event_from, $event_to)
    {
        $this->event_from = (new Carbon($event_from))->format('Y-m-d');
        $this->event_to = $event_to;
        $this->date_range = (new Carbon($event_from))->format('d/m/Y') . ' - ' . (new Carbon($event_to))->format('d/m/Y');
    }

    public function rules()
    {
        return [
            'name' => ['required', Rule::unique('events')],
            'event_from' => ['required', 'date'],
            'event_to' => ['required', 'date'],
        ];
    }

    /**
     * Store the event
     *
     * @return mixed
     */
    public function store()
    {
        $this->authorize('create', Event::class);

        $this->validate();

        // Get event data
        $data = [
            'name' => $this->name,
            'event_from' => $this->event_from,
            'event_to' => $this->event_to,
        ];

        // If user is "Comercial 1" then just send a request to create the event. The Admin will have to approve it
        if (auth()->user()->hasRole(['Comercial 1'])) {
            auth()->user()->eventRequests()->create($data);

            // Emit message if success
            $this->emit('success', __('events.alert.request.success'), sprintf(__('events.alert.request.message'), $this->name));
        } else {
            // Create event
            $event = Event::create($data);

            // Emit message if success
            $this->emit('success', __('events.alert.create.success'), sprintf(__('events.alert.create.message'), $this->name));

            // Emit event to dynamically add event to the calendar
            $this->emit('addEvent', Helper::getEventData($event));
        }

        // Reset data and hide modal
        $this->reset();
        $this->emit('hideModal');
    }
}
