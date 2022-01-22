<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'description',
        'image',
        'quantity',
        'category_id',
        'status_product_id',
        'status_operation_id',
    ];

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

    public function statusProduct()
    {
        return $this->belongsTo(StatusProduct::class);
    }

    public function statusOperation()
    {
        return $this->belongsTo(StatusOperation::class);
    }
}
