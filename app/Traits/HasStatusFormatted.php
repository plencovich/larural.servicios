<?php

namespace App\Traits;

use Illuminate\Support\HtmlString;

trait HasStatusFormatted
{
    /**
     * Get the status formatted
     *
     * @return string
     */
    public function getStatusFormattedAttribute()
    {
        if (is_null($this->status)) {
            return new HtmlString('<span class="badge badge-warning bg-warning">' . __('events.status.pending') . '</span>');
        } elseif ($this->status) {
            return new HtmlString('<span class="badge badge-success bg-success">' . __('events.status.approved') . '</span>');
        }

        return new HtmlString('<span class="badge badge-danger bg-danger">' . __('events.status.declined') . '</span>');
    }
}