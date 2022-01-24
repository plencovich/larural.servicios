<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusBudget extends Model
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

    /**
     * Get the approved status ID
     *
     * @return mixed
     */
    public static function getApprovedStatusId()
    {
        return self::where('name', 'Aprobado')->first()->id;
    }

    /**
     * Get the confirmed status ID
     *
     * @return mixed
     */
    public static function getConfirmedStatusId()
    {
        return self::where('name', 'Confirmado')->first()->id;
    }

    /**
     * Get the rejected status ID
     *
     * @return mixed
     */
    public static function getRejectedStatusId()
    {
        return self::where('name', 'Rechazado')->first()->id;
    }
}
