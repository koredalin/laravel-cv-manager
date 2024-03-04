<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UniversityService;
use App\Services\UserService;
use App\Services\SkillService;
use App\Services\CvService;
use App\Models\University;
use App\Models\User;
use App\Models\Cv;

class CvController extends Controller
{
    public function __construct(
        protected UniversityService $universityService,
        protected UserService $userService,
        protected SkillService $skillService,
        protected CvService $cvService
    ) {}

    public function addOne()
    {
        $skills = $this->skillService->findAll();
        $title = 'Създаване на CV';

        return view('index', compact(
            'skills',
            'title')
        );
    }

    public function createOne(Request $request)
    {
        $validatedData = $this->getCreateOneValidatedData($request);

        $university = University::where(['name' => $validatedData['university_name']])
            ->first();

        $user = User::where([
            'name' => $validatedData['name'],
            'middle_name' => $validatedData['middle_name'],
            'surname' => $validatedData['surname'],
            'dob' => $validatedData['dob'],
            ])
            ->first();
        $user->university_id = $university->id;
        $user->university = $university;

        $user->skills()->sync($validatedData['skills']);

        $cv = Cv::where(
            ['user_id' => $user->id]
            )
            ->first();
        if (!$cv) {
            $cv = $this->cvService->insertOne($user);
        }

        return redirect()->route('cv.add_one')->with('success', 'CV успешно създадено!');
    }

    private function getCreateOneValidatedData(Request $request): array
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'dob' => 'required|date_format:Y-m-d',
            'university_name' => 'required|max:255',
            'skills' => 'required|array',
            'skills.*' => 'exists:skills,id',
        ]);
        
        return $validatedData;
    }
}
