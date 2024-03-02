<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    // The relation to Skill model, table.
    public function skills() {
        return $this->belongsToMany(Skill::class, 'users_skills', 'user_id', 'skill_id');
    }
}
