<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $data = [
            [
                'name' => 'ユーザー１',
                'email' => 'user1@test.com',
                'phone' => '0000000001',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'test',
                'email' => 'test1@test.com',
                'phone' => '0000000002',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'test',
                'email' => 'test@test.com',
                'phone' => '0000000003',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('users')->insert($data);
    }
}
