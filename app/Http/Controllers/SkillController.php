<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Validator;
use App\Services\SkillService;
use Illuminate\Support\Facades\Log;

class SkillController extends Controller
{
    public function __construct(
        protected SkillService $skillService
    ) {}

    public function addOne(Request $request)
    {
        $validator = $this->addOneValidator($request);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorArray = $errors->all();

            return response()->json(['errors' => $errorArray], 422);
        }

        $success = true;
        $message = '';
        try {
            $skill = $this->skillService->insertOne($request->name);
        } catch (\Exception $e) {
            $success = false;
            $message = 'Моля, опитайте по-късно.';
            Log::error($e->getMessage());
            $skill = null;
        }

        return response()->json([
            'skill' => $skill,
            'success' => $success,
            'message' => $message,
        ]);
    }

    private function addOneValidator(Request $request): Validator
    {
        $validationArray = [
            'name' => 'required|unique:skills,name|string|max:255',
        ];
        $validator = ValidatorFacade::make($request->all(), $validationArray);
        
        return $validator;
    }
}
