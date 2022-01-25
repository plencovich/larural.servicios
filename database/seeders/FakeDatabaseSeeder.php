<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Zone;
use Illuminate\Database\Seeder;

class FakeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            AdminSeeder::class,
            StatusBudgetSeeder::class,
            StatusProductSeeder::class,
            StatusOperationSeeder::class,
            ProductPriceTypeSeeder::class,
        ]);

        // Create fake zone/sub zone
        $zone = Zone::create([
            'name' => 'Hogsmeade',
        ]);
        $zone->subZones()->create([
            'name' => 'Cabeza De Puerco'
        ]);

        // Create fake customer
        Customer::create([
            'name' => 'Albus',
            'lastname' => 'Dumbledore',
            'business_name' => 'Hogwarts',
            'code' => 'AB123',
            'email' => 'albus@dumbledore.com'
        ]);

        // Create fake category
        Category::create([
            'name' => 'Sin Categoría'
        ]);

        // Create fake product
        $product = Product::create([
            'code' => 'AB123',
            'name' => 'Mesa',
            'description' => 'Mesa blanca',
            'quantity' => 5,
            'category_id' => 1,
            'status_product_id' => 1,
            'status_operation_id' => 1,
            'image' => ''
        ]);
        $product->productPrices()->create([
            'product_price_type_id' => 1,
            'day_a' => 2,
            'day_b' => 3,
            'day_c' => 4,
        ]);
        $product->productPrices()->create([
            'product_price_type_id' => 2,
            'day_a' => 5,
            'day_b' => 6,
            'day_c' => 7,
        ]);
    }
}
