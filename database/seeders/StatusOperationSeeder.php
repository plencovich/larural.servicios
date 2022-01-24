<?php

namespace Database\Seeders;

use App\Models\StatusOperation;
use Illuminate\Database\Seeder;

class StatusOperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusOperation::insert([
            [
                'name' => 'Alquiler',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Venta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
