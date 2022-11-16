<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = file(__DIR__ .'/../data/region.csv');
        $data = [];

        foreach ($file as $line) {
            $dataArray = explode(',', $line,);
            $data[] = [
                'country_id' => (int)$dataArray[1],
                'name' => trim($dataArray[2]),
            ];
        }

        DB::table('regions')->insert($data);
    }
}
