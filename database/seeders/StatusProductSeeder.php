<?php

namespace Database\Seeders;

use App\Models\StatusProduct;
use Illuminate\Database\Seeder;

class StatusProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusProduct::create([
            'name' => 'Disponible'
        ]);
    }
}
