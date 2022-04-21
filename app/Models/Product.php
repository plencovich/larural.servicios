<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        // Convert date range to carbon
        $start = (new Carbon($dateFrom))->startOfDay();
        $end = (new Carbon($dateTo))->endOfDay();

        // Initialize days array
        $reservationDays = [];
        $days = [];

        // Get reservations from the selected date range
        $reservations = $this->productReservations()
            ->join('budgets', 'budgets.id', '=', 'items.budget_id')
            ->where(fn ($query) => $query->whereBetween('event_from', [$start, $end])
                ->orWhereBetween('event_to', [$start, $end])
                ->orWhereRaw('? BETWEEN event_from and event_to', [$start])
                ->orWhereRaw('? BETWEEN event_from and event_to', [$end]))
            ->groupBy('budget_id')
            ->selectRaw('event_from, event_to, sum(product_qty) as total_products_reserved')
            ->get();

        // Loop trough each reservation
        foreach ($reservations as $reservation) {
            // Get every day with their reserved quantity
            for ($i = new Carbon($reservation->event_from); $i <= $reservation->event_to; $i->modify('+1 day')) {
                $reservationDays[$i->format("Y-m-d")] = isset($reservationDays[$i->format("Y-m-d")])
                    ? $reservationDays[$i->format("Y-m-d")] + $reservation->total_products_reserved
                    : $reservation->total_products_reserved;
            }
        }

        // Loop trough each date range
        // Get every day with their reserved quantity
        for ($i = $start; $i <= $end; $i->modify('+1 day')) {
            $days[$i->format("Y-m-d")] = isset($reservationDays[$i->format("Y-m-d")]) ?  $this->quantity - $reservationDays[$i->format("Y-m-d")] : $this->quantity;
        }

        // Return days
        return collect($days);
    }

    /**
     * Get the formatted available stock
     *
     * @return mixed
     */
    public function availableStockForDateRangeFormatted($dateFrom, $dateTo)
    {
        // Get stocks per date
        $perDateStocks = $this->availableStockForDateRange($dateFrom, $dateTo);

        // If there's only one date, return the stock
        if ($perDateStocks->count() == 1) {
            return $perDateStocks->first();
        }

        // Initialize list for multiple dates
        $list = '<ul>';

        // Loop through each date
        foreach ($perDateStocks as $date => $stock) {
            // Get date and stock
            $list .= '<li>';
            $list .= $date . ': ' . $stock;
            $list .= '</li>';
        }

        // Close list
        $list .= '</ul>';

        // Return list
        return $list;
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

    /**
     * Scope a query to only include products rented
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRented($query)
    {
        return $query->whereHas('productReservations', fn ($query) => $query->whereHas('budget', fn ($budgetQuery) => $budgetQuery->where('status_budget_id', '!=', StatusBudget::getRejectedStatusId())));
    }
}
