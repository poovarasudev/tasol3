<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = [
            ['name' => SUNDAY, 'breakfast' => false, 'lunch' => false],
            ['name' => MONDAY, 'breakfast' => true, 'lunch' => true],
            ['name' => TUESDAY, 'breakfast' => true, 'lunch' => true],
            ['name' => WEDNESDAY, 'breakfast' => true, 'lunch' => true],
            ['name' => THURSDAY, 'breakfast' => true, 'lunch' => true],
            ['name' => FRIDAY, 'breakfast' => true, 'lunch' => true],
            ['name' => SATURDAY, 'breakfast' => false, 'lunch' => false],
        ];
        $firstDay = Day::first();
        if (!$firstDay) {
            foreach ($days as $day) {
                Day::create($day);
            }
        }
    }
}
