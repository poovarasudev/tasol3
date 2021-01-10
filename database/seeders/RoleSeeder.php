<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

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
            ['name' => SUPER_ADMIN_ROLE, 'guard_name' => 'web'],
            ['name' => 'Admin', 'guard_name' => 'web'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role['name'],
                'guard_name' => $role['guard_name'],
            ], [
                'name' => $role['name'],
                'guard_name' => $role['guard_name'],
            ]);
        }
    }
}
