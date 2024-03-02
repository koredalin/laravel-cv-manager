<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Helpers\DateTimeHelper;

class UserSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = DateTimeHelper::getDateTimeObj()->format('Y-m-d H:i:s');
        DB::table('users_skills')->insert([
            [
                'user_id' => 2,
                'skill_id' => 1,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'user_id' => 2,
                'skill_id' => 2,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'user_id' => 2,
                'skill_id' => 6,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'user_id' => 3,
                'skill_id' => 1,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'user_id' => 3,
                'skill_id' => 3,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'user_id' => 3,
                'skill_id' => 7,
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'user_id' => 3,
                'skill_id' => 8,
                'created_at' => $time,
                'updated_at' => $time,
            ],
        ]);
    }
}
