<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Dentist;
use App\Services\EducationService;
use App\Services\PublicService;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __construct(private PublicService $publicService,
                                private EducationService $educationService)
    {

    }

    public function index(Request $request)
    {
        $dentists = $this->publicService->getTeam();
        return view('guest/team/index', compact('dentists'));
    }

    public function show(Dentist $dentist)
    {
        $educations = $this->educationService->findByDentistId($dentist->id);
        $dentist = $this->publicService->getDetailedInformationAboutDentist($dentist->id);

        return view('guest/team/show', compact('dentist', 'educations'));
    }
}
