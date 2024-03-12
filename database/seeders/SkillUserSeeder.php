<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Helpers\DateTimeHelper;

class SkillUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = DateTimeHelper::getDateTimeObj()->format('Y-m-d H:i:s');
        DB::table('skill_user')->insert([
            [
                'skill_id' => 1,
                'user_id' => 2,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'skill_id' => 2,
                'user_id' => 2,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'skill_id' => 6,
                'user_id' => 2,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'skill_id' => 1,
                'user_id' => 3,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'skill_id' => 3,
                'user_id' => 3,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'skill_id' => 7,
                'user_id' => 3,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'skill_id' => 8,
                'user_id' => 3,
                'created_at' => $time,
                'updated_at' => $time,
            ],
        ]);
    }
}
