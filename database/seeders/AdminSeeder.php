<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'lastname' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'account_verified_at' => Carbon::now()->toDateTimeString()
        ])->assignRole('Admin');
    }
}
