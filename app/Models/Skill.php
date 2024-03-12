<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    // The relation to User model, table.
    public function users() {
        return $this->belongsToMany(User::class)->using(SkillUser::class)->withTimestamps();
    }
}
