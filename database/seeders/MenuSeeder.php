<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->truncate();

        DB::table('menus')->insert([
            [
                'name' => 'Dashboard',
                'url' => '/admin/dashboard',
                'icons' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chests manage',
                'url' => '/admin/chest-manage',
                'icons' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Items manage',
                'url' => '/admin/item-manage',
                'icons' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Packages manage',
                'url' => '/admin/package-manage',
                'icons' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Quests manage',
                'url' => '/admin/quest-manage',
                'icons' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Users manage',
                'url' => '/admin/user-manage',
                'icons' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
