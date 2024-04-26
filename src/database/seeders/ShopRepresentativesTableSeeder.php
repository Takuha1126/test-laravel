<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ShopRepresentativesTableSeeder extends Seeder
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
                'shop_id' => 1,
                'representative_name' => '田中太郎',
                'email' => 'tanaka@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'shop_id' => 2,
                'representative_name' => '佐藤花子',
                'email' => 'sato@example.com',
                'password' => Hash::make('password456'),
            ],
            [
                'shop_id' => 3,
                'representative_name' => '鈴木一郎',
                'email' => 'suzuki@example.com',
                'password' => Hash::make('password789'),
            ],
            [
                'shop_id' => 4,
                'representative_name' => '山田雅',
                'email' => 'yamada@example.com',
                'password' => Hash::make('password012'),
            ],
            [
                'shop_id' => 5,
                'representative_name' => '中村美咲',
                'email' => 'nakamura@example.com',
                'password' => Hash::make('password345'),
            ],
        ];
        DB::table('shop_representatives')->insert($params);
    }
}
