<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
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
                'rating' => 5,
                'comment' => 'とても良いお店でした。',
            ],
            [
                'rating' => 4,
                'comment' => '普通より良いお店でした。',
            ],
            [
                'rating' => 3,
                'comment' => '普通です。',
            ],
            [
                'rating' => 2,
                'comment' => '普通よりは悪いお店でした。',
            ],
            [
                'rating' => 1,
                'comment' => '最悪の経験でした。',
            ],
        ];
        DB::table('reviews')->insert($params);
    }
}
