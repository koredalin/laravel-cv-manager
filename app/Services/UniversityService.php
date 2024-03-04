<?php

namespace App\Services;

use App\Models\University;

class UniversityService
{
    public function searchUniversities($query)
    {
        return University::whereRaw('LOWER(name) LIKE ?', ['%' . trim(mb_strtolower($query)) . '%'])->get();
    }

    public function insertOne(string $name, string $assessment): ?University
    {
        $universityObj = new University();
        $universityObj->name = trim($name);
        $universityObj->assessment = round(trim($assessment), 2);
        $universityObj->save();
        
        return $universityObj;
    }
}
