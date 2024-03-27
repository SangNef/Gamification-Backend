<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'phone' => '0123456789',
                'password' => Hash::make('admin123'),
                'invite_code' => Str::random(6),
                'point' => 100,
                'is_admin' => 1,
                'skin_color'=>'#ffffff',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User',
                'phone' => '0123456788',
                'password' => Hash::make('user123'),
                'invite_code' => Str::random(6),
                'point' => 50,
                'is_admin' => 0,
                'skin_color'=>'#ffffff',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
