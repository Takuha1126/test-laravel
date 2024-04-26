<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
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
                'admin_name' => '佐藤 太郎',
                'email' => 'sato@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ],
            [
                'admin_name' => '鈴木 一郎',
                'email' => 'suzuki@example.com',
                'password' => Hash::make('password456'),
                'role' => 'admin',
            ],
            [
                'admin_name' => '高橋 美穂',
                'email' => 'takahashi@example.com',
                'password' => Hash::make('password789'),
                'role' => 'admin',
            ],
            [
                'admin_name' => '田中 裕子',
                'email' => 'tanaka@example.com',
                'password' => Hash::make('password012'),
                'role' => 'admin',
            ],
            [
                'admin_name' => '山本 健二',
                'email' => 'yamamoto@example.com',
                'password' => Hash::make('password345'),
                'role' => 'admin',
            ],
        ];
        DB::table('admins')->insert($params);
    }
}

