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
        // create seeder for users table with 1 data
        DB::table('users')->insert([
            'name' => 'admin',
            'phone' => '0559532643',
            'password' => Hash::make('admin1234'),
            'invite_code' => Str::random(6),
            'point' => 100,
            'is_admin' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
