<?php

namespace App\Services;

use App\Models\University;

class UniversityService
{
    public function searchUniversities($query)
    {
        // Изпълнете логиката за търсене на университети тук
        return University::whereRaw('LOWER(name) LIKE ?', ['%' . trim(mb_strtolower($query)) . '%'])->get();
    }

    public function insertOne(Request $request): ?University
    {
        $universityObj = new University();
        $universityObj->name = $request->name;
        $universityObj->assessment = $request->assessment;
        $universityObj->save();
        
        return $universityObj;
    }
}
