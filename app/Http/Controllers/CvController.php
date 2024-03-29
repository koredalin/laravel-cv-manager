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
        if (!empty($dobFrom)) {
            if (empty($dobTo)) {
                $dobToObj = DateTimeHelper::getDateTimeObj();
                $dobToObj->modify('+1 day');
                $dobTo = $dobToObj->format('Y-m-d');
            }
            $users = $this->userService
                ->findByDobsPeriodBuilder($dobFrom, $dobTo)
                ->paginate(self::RECORDS_PER_PAGE);
        } else {
            $users = $this->userService
                ->findAllBuilder()
                ->paginate(self::RECORDS_PER_PAGE);
        }

        $title = 'Търсене на CV по период на раждане';

        return view('cvs.search_by_dobs', compact(
            'users',
            'title')
        );
    }

    public function ageSkillsReport(Request $request)
    {
        $validatedData = $this->getAgeSkillsReportValidatedData($request);
        $cvCreatedAtFrom = $validatedData['cv_created_at_from'] ?? null;
        $cvCreatedAtTo = $validatedData['cv_created_at_to'] ?? null;
        if (!empty($cvCreatedAtFrom)) {
            if (empty($cvCreatedAtTo)) {
                $cvCreatedAtToObj = DateTimeHelper::getDateTimeObj();
                $cvCreatedAtToObj->modify('+1 day');
                $cvCreatedAtTo = $cvCreatedAtToObj->format('Y-m-d');
            }
            $users = $this->userService
                ->findAgeSkillsReportBuilder($cvCreatedAtFrom, $cvCreatedAtTo)
                ->paginate(self::RECORDS_PER_PAGE);
        } else {
            $users = $this->userService
                ->findAllAgeSkillsReportBuilder()
                ->paginate(self::RECORDS_PER_PAGE);
        }

        $title = 'Справка по възраст и умения';

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
            'dob_from' => 'nullable|date_format:Y-m-d',
            'dob_to' => 'nullable|date_format:Y-m-d',
        ]);
        
        return $validatedData;
    }

    private function getAgeSkillsReportValidatedData(Request $request): array
    {
        $validatedData = $request->validate([
            'cv_created_at_from' => 'nullable|date_format:Y-m-d',
            'cv_created_at_to' => 'nullable|date_format:Y-m-d',
        ]);
        
        return $validatedData;
    }
}
