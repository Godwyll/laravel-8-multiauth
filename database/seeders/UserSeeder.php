<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['firstname' => 'Super', 'lastname' => 'Admin', 'username' => 'admin', 'email' => 'a.godwyll@gmail.com', 'password' => Hash::make('admin@123')],
            ['firstname' => 'Godwyll', 'lastname' => 'Agyare', 'username' => 'godwyll', 'email' => 'godwyllagyare@gmail.com', 'password' => Hash::make('godwyll@123')],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
