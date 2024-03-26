<?php

namespace Database\Seeders;

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
        //
        \DB::table('menus')->insert([
            [
                'name' => 'Dashboard',
                'url' => 'admin/dashboard',
                'icon' => 'fas fa-tachometer-alt',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'Chests Manage',
                'url' => 'admin/chest-manage',
                'icon' => 'fas fa-box',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'Items Manage',
                'url' => 'admin/item-manage',
                'icon' => 'fas fa-cube',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'Packages Manage',
                'url' => 'admin/package-manage',
                'icon' => 'fas fa-box-open',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'Quests Manage',
                'url' => 'admin/quest-manage',
                'icon' => 'fas fa-tasks',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'Users Manage',
                'url' => 'admin/user-manage',
                'icon' => 'fas fa-users',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
