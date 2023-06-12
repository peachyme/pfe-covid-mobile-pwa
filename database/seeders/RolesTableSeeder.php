<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::truncate();

        // Role::create(['role' => 'admin']);
        // Role::create(['role' => 'Secrétaire médicale']);
        // Role::create(['role' => 'Coordinateur gestion social']);
        // Role::create(['role' => 'Inspécteur de prévention']);
        Role::create(['role' => 'employé']);
        Role::create(['role' => 'membre cellule de crise']);
    }
}
