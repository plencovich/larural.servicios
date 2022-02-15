<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function subZones()
    {
        return $this->hasMany(SubZone::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($zone) {
            $zone->subZones()->delete();
        });
    }
}
