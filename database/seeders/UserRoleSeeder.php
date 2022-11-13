<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_roles = [
            ['user_id' => 1, 'role_id' => 1, 'created_by' => 1],
        ];

        foreach ($user_roles as $user_role) {
            UserRole::create($user_role);
        }
    }
}
