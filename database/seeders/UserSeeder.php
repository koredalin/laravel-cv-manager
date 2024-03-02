<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Helpers\DateTimeHelper;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = DateTimeHelper::getDateTimeObj()->format('Y-m-d H:i:s');
        DB::table('users')->insert([
            [
                'name' => 'Христо',
                'middle_name' => 'Иванов',
                'surname' => 'Иванов',
                'dob' => '2000-06-09',
                'university_id' => null,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'name' => 'Христо',
                'middle_name' => 'Стоянов',
                'surname' => 'Иванов',
                'dob' => '2000-07-09',
                'university_id' => 1,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'name' => 'Христо',
                'middle_name' => 'Стоянов',
                'surname' => 'Иванов',
                'dob' => '2002-07-09',
                'university_id' => 2,
                'created_at' => $time,
                'updated_at' => $time,
            ],
        ]);
    }
}
