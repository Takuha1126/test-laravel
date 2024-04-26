<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
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
                'name' => 'John',
                'email' => 'john@example.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Jane',
                'email' => 'jane@example.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Alice',
                'email' => 'alice@example.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Bob',
                'email' => 'bob@example.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Emily',
                'email' => 'emily@example.com',
                'password' => bcrypt('password'),
            ],
        ];
        DB::table('users')->insert($params);

    }
}
