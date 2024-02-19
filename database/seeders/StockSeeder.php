<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stocks')->delete();

        // 例: 適当な日付の範囲で stocks レコードを生成
        $hotelPlans = [1, 2, 3, 4, 5, 6, 7, 8];


        $startDate = Carbon::now();
        $endDate = Carbon::now()->addMonth(); // 1ヶ月先の日付

        $datesInRange = $this->generateDateRange($startDate, $endDate);

        foreach ($hotelPlans as $hotelPlanId) {
            foreach ($datesInRange as $date) {
                DB::table('stocks')->insert([
                    'hotel_plan_id' => $hotelPlanId,
                    'day' => $date,
                    'stock' => rand(0, 5),
                ]);
            }
        }
    }

    private function generateDateRange(Carbon $start_date, Carbon $end_date)
    {
        $dates = [];

        for ($date = $start_date; $date->lte($end_date); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }
}
