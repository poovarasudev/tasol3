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

            // Role CURD
            ['name' => 'roles.index', 'group' => PERMISSION_GROUP_ROLE, 'guard_name' => 'web'],
            ['name' => 'roles.view', 'group' => PERMISSION_GROUP_ROLE, 'guard_name' => 'web'],
            ['name' => 'roles.create', 'group' => PERMISSION_GROUP_ROLE, 'guard_name' => 'web'],
            ['name' => 'roles.edit', 'group' => PERMISSION_GROUP_ROLE, 'guard_name' => 'web'],
            ['name' => 'roles.delete', 'group' => PERMISSION_GROUP_ROLE, 'guard_name' => 'web'],

            // Assign Role CURD
            ['name' => 'assign_role.index', 'group' => PERMISSION_GROUP_ASSIGN_ROLE, 'guard_name' => 'web'],
            ['name' => 'assign_role.create', 'group' => PERMISSION_GROUP_ASSIGN_ROLE, 'guard_name' => 'web'],
            ['name' => 'assign_role.edit', 'group' => PERMISSION_GROUP_ASSIGN_ROLE, 'guard_name' => 'web'],
            ['name' => 'assign_role.delete', 'group' => PERMISSION_GROUP_ASSIGN_ROLE, 'guard_name' => 'web'],

            // Menu CURD
            ['name' => 'menus.index', 'group' => PERMISSION_GROUP_MENU, 'guard_name' => 'web'],
            ['name' => 'menus.create', 'group' => PERMISSION_GROUP_MENU, 'guard_name' => 'web'],
            ['name' => 'menus.edit', 'group' => PERMISSION_GROUP_MENU, 'guard_name' => 'web'],
            ['name' => 'menus.delete', 'group' => PERMISSION_GROUP_MENU, 'guard_name' => 'web'],
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
