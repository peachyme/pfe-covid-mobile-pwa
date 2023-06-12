<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();
        // DB::table('role_user')->truncate();

        $employé = User::create([
            'nom' => 'kim',
            'prenom' => 'seokjin',
            'email' => 'seokjin@gmail.com',
            'password' => Hash::make('password'),
            'profile_image' => 'yoongi@gmail.com'
        ]);
        $membre_cellule = User::create([
            'nom' => 'min',
            'prenom' => 'yoongi',
            'email' => 'yoongi@gmail.com',
            'password' => Hash::make('password'),
            'profile_image' => 'yoongi@gmail.com'
        ]);

        $employé_role = Role::where('role','employé')->first();
        $membre_cellule_role = Role::where('role','membre cellule de crise')->first();

        $employé->roles()->attach($employé_role);
        $membre_cellule->roles()->attach($membre_cellule_role);

    }
}
