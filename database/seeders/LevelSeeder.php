<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('levels')->insert([
            [
                'level' => '1',
                'exp' => '0',
                'dame' => '10',
                'hp' => '100',
                'def' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
