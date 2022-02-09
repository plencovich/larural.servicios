<?php

namespace App\Helpers;

class Helper
{
    /**
     * Get the event array data
     *
     * @param mixed $event
     * @return mixed
     */
    public static function getEventData($event)
    {
        return [
            'title' => $event->name,
            'start' => $event->event_from ? $event->event_from->format('Y-m-d H:i:s') : null,
            'end' => $event->event_to ? $event->event_to->endOfDay()->format('Y-m-d H:i:s') : null,
            'url' => route('backoffice.budgets.edit', $event),
            // 'allDay' => true
        ];
    }
}
