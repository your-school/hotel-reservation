<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->delete();

        $data = [
            [
                'user_id' => 1,
                'message' => 'これはテストです',
                'status' => 0,
            ],
            [
                'user_id' => 2,
                'message' => 'これはテストです',
                'status' => 0,
            ],
            [
                'user_id' => 3,
                'message' => 'これはテストです',
                'status' => 1,
            ],
        ];

        DB::table('contacts')->insert($data);
    }
}
