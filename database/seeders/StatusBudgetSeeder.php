<?php

namespace Database\Seeders;

use App\Models\StatusBudget;
use Illuminate\Database\Seeder;

class StatusBudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusBudget::create([
            'name' => 'Confirmado'
        ]);
        StatusBudget::create([
            'name' => 'Aprobado'
        ]);
        StatusBudget::create([
            'name' => 'Rechazado'
        ]);
    }
}
