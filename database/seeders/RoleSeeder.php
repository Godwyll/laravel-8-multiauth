<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Administrator',
            'description' => 'Users with this role will have all permissions',
            'slug' => 'administrator',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('roles')->insert([
            'name' => 'Viewer',
            'description' => 'Users with this role will have minimal permissions',
            'slug' => 'viewer',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
