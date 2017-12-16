<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainsIdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('main_ids')->truncate();

        $data   = [];
        DB::table('mains')->get()->pluck('id')->each(function ($item) use (&$data) {
            $data[] = [
                'main_id'       => $item,
                'price'         => rand(1000, 10000),
                'created_at'    => Carbon::now()->toDateTimeString(),
                'updated_at'    => Carbon::now()->toDateTimeString(),
            ];
        });

        DB::table('main_ids')->insert($data);
    }
}
