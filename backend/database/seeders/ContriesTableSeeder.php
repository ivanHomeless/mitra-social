<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = file(__DIR__ .'/../data/country.csv');
        $data = [];

        foreach ($file as $line) {
            $dataArray = explode(',', $line,);
            $data[] = [
                "name" => trim($dataArray[1]),
            ];
        }
        DB::table('countries')->insert($data);
    }
}
