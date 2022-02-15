<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => mt_rand(10000, 99999),
            'name' => $name = $this->faker->unique()->word,
            'description' => $name,
            'quantity' => mt_rand(5, 50),
            'category_id' => 1,
            'status_product_id' => 1,
            'status_operation_id' => 1,
            'image' => ''
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Product $product) {
            //
        })->afterCreating(function (Product $product) {
            $product->productPrices()->create([
                'product_price_type_id' => 1,
                'day_a' => $firstPrice = mt_rand(5, 8),
                'day_b' => $firstPrice + 2,
                'day_c' => $firstPrice + 4,
                'day_d' => $firstPrice + 6,
            ]);
            $product->productPrices()->create([
                'product_price_type_id' => 2,
                'day_a' => $firstPrice = mt_rand(20, 40),
                'day_b' => $firstPrice + 2,
                'day_c' => $firstPrice + 4,
                'day_d' => $firstPrice + 6,
            ]);
        });
    }
}
