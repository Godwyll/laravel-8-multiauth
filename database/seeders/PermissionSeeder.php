<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'View Users',
            'slug' => 'view-users',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('permissions')->insert([
            'name' => 'Add Users',
            'slug' => 'add-users',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('permissions')->insert([
            'name' => 'Edit Users',
            'slug' => 'edit-users',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('permissions')->insert([
            'name' => 'Delete Users',
            'slug' => 'delete-users',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        
        DB::table('permissions')->insert([
            'name' => 'View Roles',
            'slug' => 'view-roles',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('permissions')->insert([
            'name' => 'Administer Roles',
            'slug' => 'administer-roles',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('permissions')->insert([
            'name' => 'View Permissions',
            'slug' => 'view-permissions',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('permissions')->insert([
            'name' => 'Administer Permissions',
            'slug' => 'administer-permissions',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('permissions')->insert([
            'name' => 'View Reports',
            'slug' => 'view-reports',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
