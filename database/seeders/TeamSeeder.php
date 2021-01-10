<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = [
            ['name' => TEAM_GUEST, 'description' => 'This is used to add guest users'],
            ['name' => TEAM_OTHERS, 'description' => 'This is used to add others users'],
            ['name' => 'PHP', 'description' => 'Php Laravel team'],
            ['name' => 'ROR', 'description' => 'Ruby team'],
            ['name' => 'Design', 'description' => 'Design team'],
        ];

        foreach ($teams as $team) {
            Team::updateOrCreate([
                'name' => $team['name']
            ], [
                'name' => $team['name'],
                'description' => $team['description'],
            ]);
        }
    }
}
