<?php

namespace App\Services;

use App\Models\Cv;
use App\Models\User;

class CvService
{
    public function insertOne(User $user): Cv
    {
        $cvObj = new Cv();
        $cvObj->user_id = $user->id;
        $cvObj->save();
        
        return $cvObj;
    }
}
