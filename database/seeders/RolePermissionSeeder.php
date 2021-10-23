<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            DB::table('role_permissions')->insert([
                'role_id' => 1,
                'permission_id' => $permission->id,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 1,
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
