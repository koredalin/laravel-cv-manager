<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Validator;
use App\Models\User;
use App\Helpers\DateTimeHelper;
use stdClass;

class UserController extends Controller
{
    public function getAddOne(Request $request)
    {
        $validator = $this->getAddOneValidator($request);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorArray = $errors->all();

            return response()->json(['errors' => $errorArray], 422);
        }

        $userObj = new User();
        $user = $userObj->findOneByNamesDob(
            $request->name,
            $request->middle_name,
            $request->surname,
            $request->dob
        );
        if (empty($user)) {
            $user = $this->insertOne($request);
        }

        return response()->json([
            'user' => $user ? $user : $userObj,
            'success' => true,
        ]);
    }

    private function getAddOneValidator(Request $request): Validator
    {
        $validationArray = [
            'name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'dob' => 'required|date_format:Y-m-d',
        ];
        $validator = ValidatorFacade::make($request->all(), $validationArray);
        
        return $validator;
    }

    private function insertOne(Request $request): ?User
    {
        $userObj = new User();
        try {
            $userObj->name = $request->name;
            $userObj->middle_name = $request->middle_name;
            $userObj->surname = $request->surname;
            $userObj->dob = DateTimeHelper::createFromDate($request->dob);
            $userObj->university_id = null;
            $userObj->save();
            $userObj->university = new stdClass();
            $userObj->skills = new stdClass();
            $userObj->cv = new stdClass();
        } catch (\Exception $e) {
            return null;
        }
        
        return $userObj;
    }
}
