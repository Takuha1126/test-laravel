<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
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
                'date' => now()->toDateString(),
                'reservation_time' => now()->addHours(1)->format('H:i:s'),
                'number_of_people' => 4,
                'status' => 'confirmed',
            ],
            [
                'user_id' => 2,
                'shop_id' => 2,
                'date' => now()->addDays(1)->toDateString(),
                'reservation_time' => now()->addDays(1)->format('H:i:s'),
                'number_of_people' => 2,
                'status' => 'pending',
            ],
            [
                'user_id' => 3,
                'shop_id' => 3,
                'date' => now()->addDays(2)->toDateString(),
                'reservation_time' => now()->addDays(2)->format('H:i:s'),
                'number_of_people' => 3,
                'status' => 'confirmed',
            ],
            [
                'user_id' => 4,
                'shop_id' => 4,
                'date' => now()->addDays(3)->toDateString(),
                'reservation_time' => now()->addDays(3)->format('H:i:s'),
                'number_of_people' => 5,
                'status' => 'pending',
            ],
            [
                'user_id' => 5,
                'shop_id' => 5,
                'date' => now()->addDays(4)->toDateString(),
                'reservation_time' => now()->addDays(4)->format('H:i:s'),
                'number_of_people' => 2,
                'status' => 'confirmed',
            ],
        ];

        DB::table('reservations')->insert($params);
    }
}

