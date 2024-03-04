<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\Skill;

class SkillService
{
    public function findAll(): Collection
    {
        return DB::table('skills')->get();
    }

    public function insertOne(string $name): Skill
    {
        $skillObj = new Skill();
        $skillObj->name = trim($name);
        $skillObj->save();
        
        return $skillObj;
    }
}
