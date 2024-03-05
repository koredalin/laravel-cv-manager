<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\DateTimeHelper;
use Illuminate\Database\Eloquent\Builder;

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

    public function insertOne(Request $request): ?User {
        $userObj = new User();
        $userObj->name = $request->name;
        $userObj->middle_name = $request->middle_name;
        $userObj->surname = $request->surname;
        $userObj->dob = DateTimeHelper::createFromDate($request->dob);
        $userObj->university_id = null;
        $userObj->save();
        $userObj->university = null;
        $userObj->skills = null;
        $userObj->cv = null;

        return $userObj;
    }

    public function findByDobsPeriodBuilder(
        string $dobFrom,
        string $dobTo
    ): Builder {
        $user = User::with(['university', 'skills', 'cv'])
            ->leftJoin('cvs', 'users.id', '=', 'cvs.user_id')
            ->where('dob', '>=', $dobFrom)
            ->where('dob', '<=', $dobTo)
            ->orderBy('users.dob')
            ->orderBy('cvs.created_at')
            ->select('users.*');

        return $user;
    }

    public function findAllBuilder(): Builder
    {
        $user = User::with(['university', 'skills', 'cv']);

        return $user;
    }
}
