<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => 'Abc',
                'email' => 'abc@gmail.com',
                'password' => 'password',
                'phone' => '8148406208',
                'gender' => GENDER_MALE,
                'team_id' => Team::where('name', 'PHP Team')->first()->id,
                'breakfast' => true,
                'lunch' => true,
            ]
        ];

        foreach ($admins as $admin) {
            $user = User::firstOrCreate([
                'email' => $admin['email']
            ], [
                'name' => $admin['name'],
                'email' => $admin['email'],
                'password' => Hash::make($admin['password']),
                'phone' => $admin['phone'],
                'team_id' => $admin['team_id'],
                'gender' => $admin['gender'],
                'breakfast' => $admin['breakfast'],
                'lunch' => $admin['lunch'],
            ]);

            $user->assignRole(SUPER_ADMIN_ROLE);
        }
    }
}
