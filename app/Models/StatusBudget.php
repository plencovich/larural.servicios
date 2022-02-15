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
     * Get the pending status ID
     *
     * @return mixed
     */
    public static function getPendingStatusId()
    {
        return self::where('name', 'Pendiente')->first()->id;
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

    /**
     * Get the Sent status ID
     *
     * @return mixed
     */
    public static function getSentStatusId()
    {
        return self::where('name', 'Enviado')->first()->id;
    }
}
