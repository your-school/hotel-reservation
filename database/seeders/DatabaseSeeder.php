<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(RoomTypeSeeder::class);
        // $this->call(RoomSeeder::class);
        $this->call(HotelSeeder::class);
        $this->call(HotelFileSeeder::class);
        $this->call(HotelPlanSeeder::class);
        $this->call(RoomTypeFileSeeder::class);
        $this->call(StockSeeder::class);
        $this->call(ContactSeeder::class);
    }
}
