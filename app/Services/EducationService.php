<?php

namespace App\Services;

use App\Http\Filters\FiltersEducationSearch;
use App\Http\Filters\FiltersUserSearch;
use App\Models\Dentist;
use App\Models\Education;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EducationService
{
    public function findAll($fields = [], $paginate = true)
    {
        if (empty($fields)) {
            $fields = ['educations.*',
            'user_dentists.name as dentist_name',
            'user_dentists.surname as dentist_surname',
            'user_dentists.patronymic as dentist_patronymic'];
        }

        $query = QueryBuilder::for(Education::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::custom('search', new FiltersEducationSearch()),
            ]);

        $query = $query
            ->join('dentists', 'educations.dentist_id', '=', 'dentists.id')
            ->join('users as user_dentists', 'dentists.user_id', '=', 'user_dentists.id');

        if ($paginate === true) {
            $result = $query->paginate(15);
        }
        else {
            $result = $query->get();
        }

        return $result;
    }

    public function findAllForAdmin()
    {
        $fields = ['user_dentists.name as dentist_name',
            'user_dentists.surname as dentist_surname',
            'user_dentists.patronymic as dentist_patronymic',
            'educations.id', 'educations.name_of_institution',
            'educations.graduation_year'];

        $query = QueryBuilder::for(Education::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::custom('search', new FiltersEducationSearch()),
            ]);

        $result = $query
            ->join('dentists', 'educations.dentist_id', '=', 'dentists.id')
            ->join('users as user_dentists', 'dentists.user_id', '=', 'user_dentists.id')
            ->paginate(15);

        return $result;
    }

    public function findById($id)
    {
        $education = Education::select()
            ->join('dentists', 'educations.dentist_id', '=', 'dentists.id')
            ->where('educations.id', '=', $id)
            ->firstOrFail();

        return $education;
    }

    public function findByDentistId($id)
    {
        $education = Education::select()
            ->join('dentists', 'educations.dentist_id', '=', 'dentists.id')
            ->where('educations.dentist_id', '=', $id)
            ->get();

        return $education;
    }

    public function create(array $data) : Education
    {
        try {
            $education = Education::create($data);

        } catch (ModelNotFoundException $e) {

        }
        catch (\Exception $e) {

        }

        return $education;
    }

    public function update(array $data, Education $education): Education
    {
        $education->update($data);
        return $education;
    }

    public function deleteById(int $id): void
    {
        $education = Education::find($id);
        $education->delete();
    }
}
