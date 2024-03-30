<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class AddEnemyMap extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Schema::table('enemies', function ($table) {
            $table->unsignedBigInteger('map_id')->default(1);
            $table->foreign('map_id')->references('id')->on('maps');
        });
    }
}
