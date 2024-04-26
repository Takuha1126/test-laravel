<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            [
                'user_id' => 1,
                'shop_id' => 1,
                'status' => true,
            ],
            [
                'user_id' => 2,
                'shop_id' => 2,
                'status' => true,
            ],
            [
                'user_id' => 3,
                'shop_id' => 3,
                'status' => false,
            ],
            [
                'user_id' => 4,
                'shop_id' => 4,
                'status' => true,
            ],
            [
                'user_id' => 5,
                'shop_id' => 5,
                'status' => false,
            ],
        ];

        DB::table('favorites')->insert($params);
    }
}


