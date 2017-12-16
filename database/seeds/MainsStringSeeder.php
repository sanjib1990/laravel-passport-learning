<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainsStringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('main_strings')->truncate();

        $data   = [];
        DB::table('mains')->get()->each(function ($item) use (&$data) {
            logger()->info($item->id);
            $data[] = [
                'main_id'       => $item->id,
                'main_string'   => $item->main,
                'price'         => rand(1000, 10000),
                'created_at'    => Carbon::now()->toDateTimeString(),
                'updated_at'    => Carbon::now()->toDateTimeString(),
            ];
        });

        DB::table('main_strings')->insert($data);
    }
}
