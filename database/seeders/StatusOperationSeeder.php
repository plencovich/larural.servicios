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
        StatusOperation::create([
            'name' => 'Alquiler'
        ]);
    }
}
