<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'event_id' => Event::factory()->create(),
            'event_from' => now(),
            'event_to' => now(),
            'discount' => 0,
            'customer_id' => Customer::factory()->create(),
            'status_budget_id' => 3,
        ];
    }
}
