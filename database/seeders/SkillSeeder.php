<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Helpers\DateTimeHelper;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = DateTimeHelper::getDateTimeObj()->format('Y-m-d H:i:s');
        DB::table('skills')->insert([
            [
                'name' => 'PHP',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'name' => 'Laravel',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'name' => 'Symfony',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'name' => 'Zend framework',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'name' => 'Ruby',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'name' => 'MySql',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'name' => 'CSS3',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'name' => 'JS',
                'created_at' => $time,
                'updated_at' => $time,
            ],
        ]);
    }
}
