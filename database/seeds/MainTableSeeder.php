<?php

use App\Models\Main;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mains')->truncate();
        factory(Main::class, 10000)->create();
    }
}
