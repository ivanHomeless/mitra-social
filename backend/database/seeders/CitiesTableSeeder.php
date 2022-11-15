<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = file(__DIR__ .'/../data/city.csv');
        $data = [];

        foreach ($file as $line) {
            $dataArray = explode(',', $line,);
            $data[] = [
                'id_region' => (int)$dataArray[1],
                'id_country' => (int)$dataArray[2],
                'name' => trim($dataArray[3]),
            ];
        }

        DB::table('cities')->insert($data);
    }
}
