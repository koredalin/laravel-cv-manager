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
use App\Helpers\DateTimeHelper;

class CvController extends Controller
{
    public const RECORDS_PER_PAGE = 8;
    
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
        $user->updated_at = DateTimeHelper::getDateTimeObj();
        $user->save();
        
        $user->university = $university;

        $user->skills()->sync($validatedData['skills']);

        $cv = Cv::where(
            ['user_id' => $user->id]
            )
            ->first();
        // If we find a CV record in the DB - we just check that it is updated.
        if ($cv) {
            $cv->updated_at = DateTimeHelper::getDateTimeObj();
            $cv->save();
        } else {
            // If there is no CV yet - we create it.
            $cv = $this->cvService->insertOne($user);
        }

        return redirect()->route('cv.add_one')->with('success', 'CV успешно създадено!');
    }

    public function searchByDobs(Request $request)
    {
        $validatedData = $this->getSearchByDobsValidatedData($request);
        $dobFrom = $validatedData['dob_from'] ?? null;
        $dobTo = $validatedData['dob_to'] ?? null;
//        print_r($request->all());
//        var_dump($dobFrom);
//        var_dump($dobTo);
        if (!empty($dobFrom)) {
            if (empty($dobTo)) {
                $dobTo = DateTimeHelper::getDateTimeObj()->format('Y-m-d');
            }
            $users = $this->userService
                ->findByDobsPeriodBuilder($dobFrom, $dobTo)
                ->paginate(self::RECORDS_PER_PAGE);
        } else {
            $users = $this->userService
                ->findAllBuilder()
                ->paginate(self::RECORDS_PER_PAGE);
        }

        $title = 'Търсене на CV по дата на раждане';

        return view('cvs.search_by_dobs', compact(
            'users',
            'title')
        );
    }

    public function ageSkillsReport(Request $request)
    {
        $validatedData = $this->getSearchByDobsValidatedData($request);
        $dobFrom = $validatedData['dob_from'] ?? null;
        $dobTo = $validatedData['dob_to'] ?? null;
//        print_r($request->all());
//        var_dump($dobFrom);
//        var_dump($dobTo);
        if (!empty($dobFrom)) {
            if (empty($dobTo)) {
                $dobTo = DateTimeHelper::getDateTimeObj()->format('Y-m-d');
            }
            $users = $this->userService
                ->findAgeSkillsReportBuilder($dobFrom, $dobTo)
                ->paginate(self::RECORDS_PER_PAGE);
        } else {
            $users = $this->userService
                ->findAllAgeSkillsReportBuilder()
                ->paginate(self::RECORDS_PER_PAGE);
        }

        $title = 'Търсене на CV по дата на раждане';

        return view('cvs.age_skills_report', compact(
            'users',
            'title')
        );
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

    private function getSearchByDobsValidatedData(Request $request): array
    {
        $validatedData = $request->validate([
            'dob_from' => 'date_format:Y-m-d',
            'dob_to' => 'date_format:Y-m-d',
        ]);
        
        return $validatedData;
    }
}
