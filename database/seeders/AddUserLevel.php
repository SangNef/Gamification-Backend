<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class AddUserLevel extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Schema::table('users', function ($table) {
            $table->unsignedBigInteger('level_id')->default(1);
            $table->foreign('level_id')->references('id')->on('levels');
        });
    }
}
