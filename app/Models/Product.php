<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all of the productPrices for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    /**
     * Get all of the productReservations for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productReservations()
    {
        return $this->hasMany(Item::class, 'product_id');
    }

    public function statusProduct()
    {
        return $this->belongsTo(StatusProduct::class);
    }

    public function statusOperation()
    {
        return $this->belongsTo(StatusOperation::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Additional methods
    |--------------------------------------------------------------------------
    */
    /**
     * Get the available stock on a date range
     *
     * @param string $dateFrom
     * @param string $dateTo
     * @return mixed
     */
    public function availableStockForDateRange($dateFrom, $dateTo)
    {
        $initialStock = $this->quantity;
        $amountFromReservations = $this->productReservations()->whereHas('budget', fn($q) => $q->whereBetween('event_from', ['2022-02-14', '2022-02-14']))->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */
    /**
     * Scope a query to only include products for rent
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForRent($query)
    {
        return $query->where('status_operation_id', StatusOperation::getForRentId());
    }
}
