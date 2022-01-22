<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPriceType extends Model
{
    use HasFactory;

    public const INTERNAL = 1;
    public const EXTERNAL = 2;
}
