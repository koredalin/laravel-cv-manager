<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public function university() {
        return $this->belongsTo(University::class, 'university_id');
    }

    // The relation to Skill model, table.
    public function skills() {
        return $this->belongsToMany(Skill::class)->using(SkillUser::class)->withTimestamps();
    }

    public function cv() {
        return $this->hasOne(CV::class, 'user_id', 'id');
    }
    
    public function findOneByNamesDob(
        string $name,
        string $middleName,
        string $surname,
        string $dob
    ): ?User {
        $user = $this->with(['university', 'skills', 'cv'])
            ->where('name', $name)
            ->where('middle_name', $middleName)
            ->where('surname', $surname)
            ->where('dob', $dob)
            ->first();

        return $user;
    }
}
