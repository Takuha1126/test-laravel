<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            ['id' => 1,'area_name' => '東京都'],
            ['id' => 2,'area_name' => '大阪府'],
            ['id' => 3,'area_name' => '福岡県'],
        ]);
    }
}
