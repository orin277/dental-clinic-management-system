<?php

namespace App\Services;

use App\Models\Dentist;
use App\Models\Service;
use App\Models\TypeOfService;

class PublicService
{
    public function getServices()
    {
        $result = TypeOfService::select('id', 'name')
            ->with('services:type_of_service_id,name,price')
            ->get();

        return $result;
    }

    public function getTeam()
    {
        $result = Dentist::select('users.name', 'users.surname', 'users.patronymic', 'users.avatar',
            'dentists.id', 'dentists.user_id', 'dentists.dentist_specialization_id',
            'dentist_specializations.name as dentist_specialization_name')
            ->join('users', 'dentists.user_id', '=', 'users.id')
            ->join('dentist_specializations', 'dentists.dentist_specialization_id', '=', 'dentist_specializations.id')
            ->get();

        return $result;
    }

    public function getDetailedInformationAboutDentist($id)
    {
        $result = Dentist::select('users.name', 'users.surname', 'users.patronymic', 'users.avatar',
            'dentists.id', 'dentists.user_id', 'dentists.dentist_specialization_id', 'dentists.work_experience',
            'dentist_specializations.name as dentist_specialization_name')
            ->join('users', 'dentists.user_id', '=', 'users.id')
            ->join('dentist_specializations', 'dentists.dentist_specialization_id', '=', 'dentist_specializations.id')
            ->with(['educations' => function ($query) {
                $query->select('id', 'dentist_id', 'name_of_institution', 'graduation_year');
            }])
            ->where('dentists.id', '=', $id)
            ->firstOrFail();

        return $result;
    }
}
