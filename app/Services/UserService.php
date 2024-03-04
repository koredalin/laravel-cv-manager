<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function findOneByNamesDob(
        string $name,
        string $middleName,
        string $surname,
        string $dob
    ): ?User {
        $user = User::with(['university', 'skills', 'cv'])
            ->where('name', $name)
            ->where('middle_name', $middleName)
            ->where('surname', $surname)
            ->where('dob', $dob)
            ->first();

        return $user;
    }
}
