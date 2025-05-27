<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Services\PublicService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __construct(private PublicService $publicService)
    {

    }
    public function __invoke(Request $request)
    {
        $typeOfServices = $this->publicService->getServices();
        return view('guest/services', compact('typeOfServices'));
    }
}
