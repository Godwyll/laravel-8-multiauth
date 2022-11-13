<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_permissions = [
            ['user_id' => 1, 'permission_id' => 1, 'created_by' => 1]
        ];

        foreach ($user_permissions as $user_permission) {
            UserPermission::create($user_permission);
        }            
    }
}
