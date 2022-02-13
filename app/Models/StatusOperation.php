<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusOperation extends Model
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

    /*
    |--------------------------------------------------------------------------
    | Special Methods
    |--------------------------------------------------------------------------
    */
    /**
     * Get the ID of the operation for rent
     *
     * @return mixed
     */
    public static function getForRentId()
    {
        return 1;
    }
}
