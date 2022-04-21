<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Event;
use App\Models\Item;
use App\Models\Product;
use App\Models\User;
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
        $zone = Zone::create([
            'name' => 'Middle Earth',
        ]);
        $zone->subZones()->create([
            'name' => 'Rivendel'
        ]);
        $zone->subZones()->create([
            'name' => 'Isengard'
        ]);
        $zone->subZones()->create([
            'name' => 'Dol Guldur'
        ]);

        // Create test comercial user
        $comercial = User::create([
            'name' => 'Comercial',
            'lastname' => 'Usuario',
            'email' => 'comercial@user.com',
            'password' => '$2y$10$6/A8f3HRJkc06OESgy1hteITCpKmr2yoCOQgtpKkoEOVQPoZ6s0Ym', // 11111111
            'account_verified_at' => now()
        ]);

        $comercial->assignRole('Comercial 1');

        // Create fake customer
        Customer::create([
            'name' => 'Albus',
            'lastname' => 'Dumbledore',
            'business_name' => 'Hogwarts',
            'code' => 'AB123',
            'email' => 'albus@dumbledore.com'
        ]);
        Customer::create([
            'name' => 'Gandalf',
            'lastname' => 'Mithrandir',
            'business_name' => 'El Concilio Blanco',
            'code' => 'AB124',
            'email' => 'gandalf@mithrandir.com'
        ]);

        // Create fake category
        Category::create([
            'name' => 'Sin Categoría'
        ]);

        // Create fake product
        Product::factory()->count(20)->has(Item::factory(), 'productReservations')->create();

        // Create an event for the following 5 days
        Event::create([
            'name' => 'Fiesta en Rivendel',
            'event_from' => now()->addDay()->startOfDay(),
            'event_to' => now()->addDays(6)->startOfDay(),
        ]);
    }
}
