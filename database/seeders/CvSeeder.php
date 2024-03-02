<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Helpers\DateTimeHelper;

class CvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = DateTimeHelper::getDateTimeObj()->format('Y-m-d H:i:s');
        DB::table('cvs')->insert([
            [
                'user_id' => 2,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'user_id' => 3,
                'created_at' => $time,
                'updated_at' => $time,
            ],
        ]);
    }
}
