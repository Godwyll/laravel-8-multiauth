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
            'firstname' => 'Super',
            'lastname' => 'Admin',
            'username' => 'admin',
            'email' => 'a.godwyll@gmail.com',
            'password' => Hash::make('admin@123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'firstname' => 'Godwyll',
            'lastname' => 'Agyare',
            'username' => 'godwyll',
            'email' => 'godwyllagyare@gmail.com',
            'password' => Hash::make('godwyll@123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
