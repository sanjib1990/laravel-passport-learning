<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MainTableSeeder::class);
        $this->call(MainsIdsSeeder::class);
        $this->call(MainTableSeeder::class);
    }
}
