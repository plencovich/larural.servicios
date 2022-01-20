<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'event_name',
        'event_at',
        'disccount',
        'observations',
        'customer_id',
        'status_budget_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function status()
    {
        return $this->hasOne(StatusBudget::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
