<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Helpers\DateTimeHelper;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = DateTimeHelper::getDateTimeObj()->format('Y-m-d H:i:s');
        DB::table('universities')->insert([
            [
                'name' => 'СУ - София',
                'assessment' => 9.38,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'name' => 'ТУ - София',
                'assessment' => 8.98,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'name' => 'УНСС - София',
                'assessment' => 8.99,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'name' => 'ИУ - Варна',
                'assessment' => 9.03,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'name' => 'ТУ - Варна',
                'assessment' => 9.05,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'name' => 'ВСУ - Черноризец Храбър',
                'assessment' => 8.88,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'name' => 'ВВМУ - Никола Йонков Вапцаров - Варна',
                'assessment' => 9.78,
                'created_at' => $time,
                'updated_at' => $time,
            ],
        ]);
    }
}
