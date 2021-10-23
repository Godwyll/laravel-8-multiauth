<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert([
            'user_id' => 1,
            'role_id' => 1,
            'added_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        

    }
}
