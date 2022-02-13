<?php

namespace App\Helpers;

use Carbon\Carbon;

class Helper
{
    /**
     * Get date in Spanish format d/m/Y
     *
     * @param string $date
     * @return mixed
     */
    public static function formatEs($date)
    {
        return (new Carbon($date))->format('d/m/Y');
    }

    /**
     * Get the event array data
     *
     * @param mixed $event
     * @return mixed
     */
    public static function getEventData($event)
    {
        return [
            'id' => $event->id,
            'title' => $event->name,
            'start' => $event->event_from ? $event->event_from->format('Y-m-d H:i:s') : null,
            'end' => $event->event_to ? $event->event_to->endOfDay()->format('Y-m-d H:i:s') : null,
            // 'url' => route('backoffice.budgets.edit', $event),
            // 'allDay' => true
        ];
    }
}
