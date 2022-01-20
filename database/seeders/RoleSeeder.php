<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $encargadoDeposito = Role::create(['name' => 'Encargado de depósito']);
        $superiorOperaciones = Role::create(['name' => 'Superior de operaciones']);
        $encargadoTranslado = Role::create(['name' => 'Encargado trasladar mobiliario']);
        $serviciosFeriales1 = Role::create(['name' => 'Servicios Feriales 1']);
        $serviciosFeriales2 = Role::create(['name' => 'Servicios Feriales 2']);
        $comercial1 = Role::create(['name' => 'Comercial 1']);
    }
}
