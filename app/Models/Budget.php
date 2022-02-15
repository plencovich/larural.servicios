<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'event_from', 'event_to'];

    /*
    |--------------------------------------------------------------------------
    | Relationship
    |--------------------------------------------------------------------------
    */

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the event that owns the Budget
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function status()
    {
        return $this->hasOne(StatusBudget::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Additional methods
    |--------------------------------------------------------------------------
    */

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
     * Check if the budget is pending
     *
     * @return mixed
     */
    public function isPending()
    {
        return $this->status_budget_id == StatusBudget::getPendingStatusId();
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
     * Check if the budget is sent
     *
     * @return mixed
     */
    public function isSent()
    {
        return $this->status_budget_id == StatusBudget::getSentStatusId();
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    /**
     * Get the status
     *
     * @return string
     */
    public function getStatusAttribute()
    {
        if ($this->isPending()) {
            return 'Pendiente';
        } else if ($this->isSent()) {
            return 'Enviado';
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
        // Sum the totals from the items
        $total = $this->items->sum(fn ($item) => $item->product_qty * $item->product_price);

        // Get the discount percent and convert NULL to 0
        $discountPercent = $this->discount > 0 ? $this->discount : 0;

        // Calculate total amount
        $discount = ($total * $discountPercent) / 100;

        // Get total with discount
        $totalWithDiscount = $total - $discount;

        // Get the total discount per products
        $productsDiscount = ($totalWithDiscount * $this->items->sum->discount) / 100;

        return number_format($total - $discount - $productsDiscount, 2);
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
