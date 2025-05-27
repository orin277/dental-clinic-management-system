<?php

namespace App\Services;

use App\Models\Dentist;
use App\Models\Service;
use App\Models\TypeOfService;

class PublicService
{
    public function getServices()
    {
//        $result = Service::select('services.*', 'type_of_services.name as type_of_service_name')
//            ->join('type_of_services', 'services.type_of_service_id', '=', 'type_of_services.id')
//            ->get();

        $result = TypeOfService::with('services')->get();

        return $result;
    }

    public function getTeam()
    {
        $result = Dentist::select('users.*', 'dentists.*', 'dentist_specializations.name as dentist_specialization_name')
            ->join('users', 'dentists.user_id', '=', 'users.id')
            ->join('dentist_specializations', 'dentists.dentist_specialization_id', '=', 'dentist_specializations.id')
            ->get();

        return $result;
    }

    public function getDetailedInformationAboutDentist($id)
    {
        $result = Dentist::select('users.*', 'dentists.*', 'dentist_specializations.name as dentist_specialization_name')
            ->join('users', 'dentists.user_id', '=', 'users.id')
            ->join('dentist_specializations', 'dentists.dentist_specialization_id', '=', 'dentist_specializations.id')
            ->where('dentists.id', '=', $id)
            ->firstOrFail();

        return $result;
    }
}
