<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Validator;
use App\Services\UniversityService;

class UniversityController extends Controller
{
    public function __construct(
        protected UniversityService $universityService
    ) {}

    public function searchByName(string $name)
    {
        $universities = $this->universityService->searchUniversities($name);
        
        return response()->json($universities);
    }

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
            $university = $this->universityService->insertOne($request);
        } catch (\Exception $e) {
            $success = false;
            $message = 'Моля, опитайте по-късно.';
            $university = null;
        }

        return response()->json([
            'university' => $university,
            'success' => $success,
            'message' => $message,
        ]);
    }

    private function addOneValidator(Request $request): Validator
    {
        $validationArray = [
            'name' => 'required|string|max:255',
            'assessment' => 'required|float|decimal:2|min:0.00|max:10.00',
        ];
        $validator = ValidatorFacade::make($request->all(), $validationArray);
        
        return $validator;
    }
}
