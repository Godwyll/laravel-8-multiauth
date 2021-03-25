<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'firstname' => 'Super',
            'lastname' => 'Admin',
            'username' => 'admin',
            'email' => 'a.godwyll@gmail.com',
            'password' => Hash::make('admin@123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
