<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Validator;
use App\Services\UserService;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}
    
    public function getAddOne(Request $request)
    {
        $validator = $this->getAddOneValidator($request);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorArray = $errors->all();

            return response()->json(['errors' => $errorArray], 422);
        }

        $success = true;
        $message = '';
        try {
            $user = $this->userService->findOneByNamesDob(
                $request->name,
                $request->middle_name,
                $request->surname,
                $request->dob
            );
            if (empty($user)) {
                $user = $this->userService->insertOne($request);
            }
        } catch (\Exception $e) {
            $success = false;
            $message = 'Моля, опитайте по-късно.';
            Log::error($e->getMessage());
            $user = null;
        }

        return response()->json([
            'user' => $user,
            'success' => $success,
            'message' => $message,
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
}
