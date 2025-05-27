<?php

namespace App\Services;

use App\Http\Filters\FiltersUserSearch;
use App\Http\Filters\FiltersVacationSearch;
use App\Models\Dentist;
use App\Models\Vacation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class VacationService
{
    public function findAll($fields = [], $paginate = true)
    {
        if (empty($fields)) {
            $fields = ['users.name',
                'users.surname',
                'users.patronymic',
                'vacations.*'];
        }

        $query = QueryBuilder::for(Vacation::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::custom('search', new FiltersVacationSearch()),
            ]);

        $query = $query
            ->join('dentists', 'vacations.dentist_id', '=', 'dentists.id')
            ->join('users', 'dentists.user_id', '=', 'users.id');

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
        $fields = ['users.name', 'users.surname', 'users.patronymic',
            'vacations.id', 'vacations.start', 'vacations.end'];

        $query = QueryBuilder::for(Vacation::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::custom('search', new FiltersVacationSearch()),
            ]);

        $result = $query
            ->join('dentists', 'vacations.dentist_id', '=', 'dentists.id')
            ->join('users', 'dentists.user_id', '=', 'users.id')
            ->paginate(15);

        return $result;
    }

    public function findById($id)
    {
        $vacation = Vacation::select('user_dentists.name',
            'user_dentists.surname',
            'user_dentists.patronymic',
            'vacations.*')
            ->join('dentists', 'vacations.dentist_id', '=', 'dentists.id')
            ->join('users as user_dentists', 'dentists.user_id', '=', 'user_dentists.id')
            ->where('vacations.id', '=', $id)
            ->firstOrFail();

        return $vacation;
    }

    public function findByDentistId($id)
    {
        $vacations = Vacation::select(
            'vacations.*')
            ->where('vacations.dentist_id', '=', $id)
            ->get();

        return $vacations;
    }

    public function create(array $data) : Vacation
    {
        try {
            $vacation = Vacation::create($data);

        } catch (ModelNotFoundException $e) {

        }
        catch (\Exception $e) {

        }

        return $vacation;
    }

    public function update(array $data, Vacation $vacation): Vacation
    {
        $vacation->update($data);
        return $vacation;
    }

    public function deleteById(int $id): void
    {
        $vacation = Vacation::find($id);
        $vacation->delete();
    }
}
