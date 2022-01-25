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
        'discount',
        'observations',
        'customer_id',
        'status_budget_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'event_from_at', 'event_to_at'];

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

    /**
     * Check if the budget is approved
     *
     * @return mixed
     */
    public function isApproved()
    {
        return $this->status_budget_id == StatusBudget::getApprovedStatusId();
    }

    /**
     * Check if the budget is confirmed
     *
     * @return mixed
     */
    public function isConfirmed()
    {
        return $this->status_budget_id == StatusBudget::getConfirmedStatusId();
    }

    /**
     * Check if the budget is rejected
     *
     * @return mixed
     */
    public function isRejected()
    {
        return $this->status_budget_id == StatusBudget::getRejectedStatusId();
    }

    /**
     * Get the status
     *
     * @return string
     */
    public function getStatusAttribute()
    {
        if ($this->isConfirmed()) {
            return 'Confirmado';
        } else if ($this->isApproved()) {
            return 'Aprobado';
        } else if ($this->isRejected()) {
            return 'Rechazado';
        }

        return 'No Especificado';
    }

    /**
     * Get the total
     *
     * @return string
     */
    public function getTotalAttribute()
    {
        $total = $this->items->sum(fn ($item) => $item->product_qty * $item->product_price);
        $discount = ($total * $this->discount) / 100;

        return number_format($total - $discount, 2);
    }

    /**
     * Get the total without discount
     *
     * @return string
     */
    public function getTotalWithoutDiscountAttribute()
    {
        return number_format($this->items->sum(fn ($item) => $item->product_qty * $item->product_price), 2);
    }

    /**
     * Get the discount formatted
     *
     * @return string
     */
    public function getDiscountFormattedAttribute()
    {
        return number_format($this->discount ?? 0, 2);
    }
}
