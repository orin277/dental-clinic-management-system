<?php

namespace App\Services;

use App\Http\Filters\FiltersAppointmentSearch;
use App\Http\Filters\FiltersUserSearch;
use App\Models\Appointment;
use App\Models\Dentist;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class DentistService
{
    public function getDentistsForDropdownList()
    {
        $dentists = Dentist::select(
            'dentists.id', 'users.name', 'users.surname', 'users.patronymic')
            ->join('users', 'dentists.user_id', '=', 'users.id')
            ->get();

        return $dentists;
    }

    public function getDentistsForDropdownListAppointmentBooking()
    {
        $dentists = Dentist::select(
            'dentists.id', 'users.name', 'users.surname', 'users.patronymic',
            'dentist_specializations.name as dentist_specializations_name', 'dentists.cabinet')
            ->join('users', 'dentists.user_id', '=', 'users.id')
            ->join('dentist_specializations', 'dentists.dentist_specialization_id', '=', 'dentist_specializations.id')
            ->get();

        return $dentists;
    }

    public function findAll($fields = [], $paginate = true)
    {
        if (empty($fields)) {
            $fields = ['users.*', 'dentists.*', 'dentist_specializations.name as dentist_specializations_name'];
        }

        $query = QueryBuilder::for(Dentist::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::custom('search', new FiltersUserSearch()),
            ]);

        $query = $query
            ->join('users', 'dentists.user_id', '=', 'users.id')
            ->join('dentist_specializations', 'dentists.dentist_specialization_id', '=', 'dentist_specializations.id');

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
            'users.phone', 'users.date_of_birth', 'users.email',
            'dentists.id', 'dentists.sex', 'dentists.cabinet',
            'dentist_specializations.name as dentist_specializations_name'];

        $query = QueryBuilder::for(Dentist::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::custom('search', new FiltersUserSearch()),
            ]);

        $result = $query
            ->join('users', 'dentists.user_id', '=', 'users.id')
            ->join('dentist_specializations', 'dentists.dentist_specialization_id', '=', 'dentist_specializations.id')
            ->paginate(15);

        return $result;
    }

    public function findById($id)
    {
         $dentist = Dentist::select('users.*', 'dentists.*', 'dentist_specializations.name as dentist_specializations_name')
            ->join('users', 'dentists.user_id', '=', 'users.id')
            ->join('dentist_specializations', 'dentists.dentist_specialization_id', '=', 'dentist_specializations.id')
            ->where('dentists.id', '=', $id)
            ->firstOrFail();

        return $dentist;
    }

    public function findByUserId($id)
    {
        $dentist = Dentist::select('users.*', 'dentists.*', 'dentist_specializations.name as dentist_specializations_name')
            ->join('users', 'dentists.user_id', '=', 'users.id')
            ->join('dentist_specializations', 'dentists.dentist_specialization_id', '=', 'dentist_specializations.id')
            ->where('users.id', '=', $id)
            ->firstOrFail();

        return $dentist;
    }

    public function create(array $data) : Dentist
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $data['name'],
                'surname' => $data['surname'],
                'patronymic' => $data['patronymic'],
                'phone' => $data['phone'],
                'date_of_birth' => $data['date_of_birth'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $dentist = Dentist::create([
                'cabinet' => $data['cabinet'],
                'address' => $data['address'],
                'sex' => $data['sex'],
                'work_experience' => $data['work_experience'],
                'user_id' => $user->id,
                'dentist_specialization_id' => $data['dentist_specialization_id']
            ]);

            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            throw $e;
        }
        catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return $dentist;
    }

    public function update(array $data, Dentist $dentist)
    {
        try {
            DB::beginTransaction();

            $userData = array();
            if (array_key_exists('name', $data))
                $userData['name'] = $data['name'];
            if (array_key_exists('surname', $data))
                $userData['surname'] = $data['surname'];
            if (array_key_exists('patronymic', $data))
                $userData['patronymic'] = $data['patronymic'];
            if (array_key_exists('phone', $data))
                $userData['phone'] = $data['phone'];
            if (array_key_exists('date_of_birth', $data))
                $userData['date_of_birth'] = $data['date_of_birth'];
            if (array_key_exists('email', $data))
                $userData['email'] = $data['email'];
            if (array_key_exists('password', $data))
                $userData['password'] = Hash::make($data['password']);

            $user = User::where('id', $dentist->user_id)->update($userData);

            $dentistData = array();
            if (array_key_exists('cabinet', $data))
                $dentistData['cabinet'] = $data['cabinet'];
            if (array_key_exists('address', $data))
                $dentistData['address'] = $data['address'];
            if (array_key_exists('sex', $data))
                $dentistData['sex'] = $data['sex'];
            if (array_key_exists('work_experience', $data))
                $dentistData['work_experience'] = $data['work_experience'];
            if (array_key_exists('dentist_specialization_id', $data))
                $dentistData['dentist_specialization_id'] = $data['dentist_specialization_id'];

            Dentist::where('id', $dentist->id)->update($dentistData);

            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            throw $e;
        }
        catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return $dentist;
    }

    public function deleteById(int $id): void
    {
        $dentist = Dentist::find($id);
        $dentist->delete();
    }
}
