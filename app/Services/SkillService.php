<?php

namespace App\Services;

use App\Models\Skill;

class SkillService
{
    public function insertOne(string $name): Skill
    {
        $skill = new Skill();
        $skill->name = trim($name);
        $skill->save();
        
        return $skill;
    }
}
