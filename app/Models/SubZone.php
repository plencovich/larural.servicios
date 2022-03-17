<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubZone extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'zone_id',
    ];

    public function zone()
    {
        return $this->hasOne(Zone::class);
    }

    /**
     * Get the singleZone that owns the SubZone
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function singleZone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }
}
