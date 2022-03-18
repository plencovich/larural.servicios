<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class EventRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at', 'event_from', 'event_to'];

    /**
     * Get the user that owns the EventRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
