<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            // Breakfast
            ['name' => 'Idly', 'for' => MENU_FOR_BREAKFAST, 'order_type' => ORDER_TYPE_SINGLE, 'bill_type' => BILL_TYPE_PER_UNIT, 'price' => 7],
            ['name' => 'Chapati', 'for' => MENU_FOR_BREAKFAST, 'order_type' => ORDER_TYPE_SINGLE, 'bill_type' => BILL_TYPE_PER_UNIT, 'price' => 13],
            ['name' => 'Boori', 'for' => MENU_FOR_BREAKFAST, 'order_type' => ORDER_TYPE_SINGLE, 'bill_type' => BILL_TYPE_PER_UNIT, 'price' => 13],
            ['name' => 'Dosa', 'for' => MENU_FOR_BREAKFAST, 'order_type' => ORDER_TYPE_SINGLE, 'bill_type' => BILL_TYPE_PER_UNIT, 'price' => 13],

            // Lunch
            ['name' => 'Rice', 'for' => MENU_FOR_LUNCH, 'order_type' => ORDER_TYPE_SINGLE, 'bill_type' => BILL_TYPE_EQUALLY_DIVIDED, 'price' => 65],
            ['name' => 'Tomato Rice', 'for' => MENU_FOR_LUNCH, 'order_type' => ORDER_TYPE_MULTIPLE, 'bill_type' => BILL_TYPE_PER_UNIT, 'price' => 20],
            ['name' => 'Lemon Rice', 'for' => MENU_FOR_LUNCH, 'order_type' => ORDER_TYPE_MULTIPLE, 'bill_type' => BILL_TYPE_PER_UNIT, 'price' => 20],
            ['name' => 'Curd Rice', 'for' => MENU_FOR_LUNCH, 'order_type' => ORDER_TYPE_MULTIPLE, 'bill_type' => BILL_TYPE_PER_UNIT, 'price' => 20],
        ];

        foreach ($menus as $menu) {
            Menu::firstOrCreate([
                'name' => $menu['name'],
                'for' => $menu['for']
            ], [
                'name' => $menu['name'],
                'for' => $menu['for'],
                'order_type' => $menu['order_type'],
                'bill_type' => $menu['bill_type'],
                'price' => $menu['price']
            ]);
        }
    }
}
