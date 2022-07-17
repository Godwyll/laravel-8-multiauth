<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Administrator', 'description' => 'Users with this role will have all permissions', 'slug' => 'administrator'],        
            ['name' => 'Viewer', 'description' => 'Users with this role will have minimal permissions', 'slug' => 'viewer'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
