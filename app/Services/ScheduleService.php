<?php

namespace App\Services;

use App\Http\Filters\FiltersEducationSearch;
use App\Models\DayOfWeek;
use App\Models\Education;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Vacation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ScheduleService
{
    public function findAll($params = [], $fields = [], $paginate = true)
    {
        if (empty($fields)) {
            $fields = ['user_dentists.name as dentist_name',
                'user_dentists.surname as dentist_surname',
                'user_dentists.patronymic as dentist_patronymic',
                'schedules.*', 'day_of_weeks.name as day_of_week_name'];
        }

        $query = Schedule::select($fields);

        if (isset($params['dentist_id'])) {
            $query->byDentistId($params['dentist_id']);
        }

        $query = QueryBuilder::for(Schedule::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::custom('search', new FiltersEducationSearch()),
            ]);

        $query = $query
            ->join('dentists', 'schedules.dentist_id', '=', 'dentists.id')
            ->join('day_of_weeks', 'schedules.day_of_week_id', '=', 'day_of_weeks.id')
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
            'schedules.id', 'schedules.start_time', 'schedules.end_time',
            'day_of_weeks.name as day_of_week_name'];

        $query = QueryBuilder::for(Schedule::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::custom('search', new FiltersEducationSearch()),
            ]);

        $result = $query
            ->join('dentists', 'schedules.dentist_id', '=', 'dentists.id')
            ->join('day_of_weeks', 'schedules.day_of_week_id', '=', 'day_of_weeks.id')
            ->join('users as user_dentists', 'dentists.user_id', '=', 'user_dentists.id')
            ->paginate(15);

        return $result;
    }

    public function findAllForDentist($dentistId)
    {
        $fields = ['schedules.id', 'schedules.start_time', 'schedules.end_time',
            'day_of_weeks.name as day_of_week_name'];

        $query = QueryBuilder::for(Schedule::class)
            ->select($fields)
            ->allowedFilters([
                'day_of_week_id'
            ]);

        $result = $query
            ->join('day_of_weeks', 'schedules.day_of_week_id', '=', 'day_of_weeks.id')
            ->byDentistId($dentistId)
            ->paginate(15);

        return $result;
    }

    public function findById($id)
    {
        $schedule = Schedule::select(
            'user_dentists.name as dentist_name',
            'user_dentists.surname as dentist_surname',
            'user_dentists.patronymic as dentist_patronymic',
            'schedules.*', 'day_of_weeks.name as day_of_week_name')
            ->join('dentists', 'schedules.dentist_id', '=', 'dentists.id')
            ->join('day_of_weeks', 'schedules.day_of_week_id', '=', 'day_of_weeks.id')
            ->join('users as user_dentists', 'dentists.user_id', '=', 'user_dentists.id')
            ->where('schedules.id', '=', $id)
            ->firstOrFail();

        return $schedule;
    }

    public function findByDentistId($id)
    {
        $schedules = Schedule::select(
            'schedules.*')
            ->where('schedules.dentist_id', '=', $id)
            ->get();

        return $schedules;
    }

    public function findByDentistIdAndDayOfWeekId($id, $dayOfWeekId)
    {
        $schedules = Schedule::select(
            'schedules.*')
            ->where('schedules.dentist_id', '=', $id)
            ->where('schedules.day_of_week_id', '=', $dayOfWeekId)
            ->get();

        return $schedules;
    }

    public function findDayOfWeeks() : Collection
    {
        $dayOfWeeks = DayOfWeek::get();

        return $dayOfWeeks;
    }

    public function getDayOfWeeks()
    {
        $result = DayOfWeek::select(['id', 'name'])->get();

        return $result;
    }

    public function create(array $data) : Schedule
    {
        try {
            $schedule = Schedule::create($data);

        } catch (ModelNotFoundException $e) {

        }
        catch (\Exception $e) {

        }

        return $schedule;
    }

    public function update(array $data, Schedule $schedule): Schedule
    {
        $schedule->update($data);
        return $schedule;
    }

    public function deleteById(int $id): void
    {
        $schedule = Schedule::find($id);
        $schedule->delete();
    }
}
