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
        StatusProduct::insert([
            [
                'name' => 'Disponible',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'En Uso',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mantenimiento',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Reservado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
