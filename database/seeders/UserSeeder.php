<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'role_id' => 2,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Korea Platea vivamus',
            'role_id' => 4,
            'email' => 'korea@gmail.com',
            'password' => Hash::make('korea123'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Korwil Dui ornare',
            'role_id' => 3,
            'email' => 'korwil@gmail.com',
            'password' => Hash::make('korwil123'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Korea Tristique turpis',
            'role_id' => 4,
            'email' => 'korea2@gmail.com',
            'password' => Hash::make('korea123'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Korwil Vitae diam',
            'role_id' => 3,
            'email' => 'korwil2@gmail.com',
            'password' => Hash::make('korwil123'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
