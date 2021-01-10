<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

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
            // User CURD
            ['name' => 'users.index', 'group' => PERMISSION_GROUP_USER, 'guard_name' => 'web'],
            ['name' => 'users.view', 'group' => PERMISSION_GROUP_USER, 'guard_name' => 'web'],
            ['name' => 'users.create', 'group' => PERMISSION_GROUP_USER, 'guard_name' => 'web'],
            ['name' => 'users.edit', 'group' => PERMISSION_GROUP_USER, 'guard_name' => 'web'],
            ['name' => 'users.delete', 'group' => PERMISSION_GROUP_USER, 'guard_name' => 'web'],

            // Team CURD
            ['name' => 'teams.index', 'group' => PERMISSION_GROUP_TEAM, 'guard_name' => 'web'],
            ['name' => 'teams.create', 'group' => PERMISSION_GROUP_TEAM, 'guard_name' => 'web'],
            ['name' => 'teams.edit', 'group' => PERMISSION_GROUP_TEAM, 'guard_name' => 'web'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission['name'],
                'group' => $permission['group'],
                'guard_name' => $permission['guard_name'],
            ], [
                'name' => $permission['name'],
                'group' => $permission['group'],
                'guard_name' => $permission['guard_name'],
            ]);
        }
    }
}
