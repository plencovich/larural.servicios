<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'zone_name' => 1,
            'sub_zone_name' => 1,
            'product_id' => Product::factory()->create(),
            'product_qty' => mt_rand(5, 50),
            'product_price' => mt_rand(1, 5),
            'discount' => 0,
            'budget_id' => Budget::factory()->create(),
        ];
    }
}
