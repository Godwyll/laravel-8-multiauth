<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'View Users', 'slug' => 'view-users'],
            ['name' => 'Add Users', 'slug' => 'add-users'],
            ['name' => 'Edit Users', 'slug' => 'edit-users'],
            ['name' => 'Delete Users', 'slug' => 'delete-users'],
            ['name' => 'View Roles', 'slug' => 'view-roles'],
            ['name' => 'Administer Roles', 'slug' => 'administer-roles'],
            ['name' => 'View Permissions', 'slug' => 'view-permissions'],
            ['name' => 'Administer Permissions', 'slug' => 'administer-permissions'],
            ['name' => 'View Reports', 'slug' => 'view-reports'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
