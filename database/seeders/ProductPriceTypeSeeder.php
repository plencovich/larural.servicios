<?php

namespace Database\Seeders;

use App\Models\ProductPriceType;
use Illuminate\Database\Seeder;

class ProductPriceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductPriceType::insert([
            [
                'name' => 'Interno',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Externo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
