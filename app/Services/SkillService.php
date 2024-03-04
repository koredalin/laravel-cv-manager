<?php

namespace App\Services;

use App\Models\Skill;

class SkillService
{
    public function searchUniversities($query)
    {
        return Skill::whereRaw('LOWER(name) LIKE ?', ['%' . trim(mb_strtolower($query)) . '%'])->get();
    }

    public function insertOne(string $name): ?Skill
    {
        $skill = new Skill();
        $skill->name = trim($name);
        $skill->save();
        
        return $skill;
    }
}
