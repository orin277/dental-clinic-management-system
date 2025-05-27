<?php

namespace App\Services;

use App\Http\Filters\FiltersUserSearch;
use App\Models\Dentist;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PatientService
{
    public function getPatientsForDropdownList()
    {
        $patients = Patient::select('patients.id', 'users.name', 'users.surname', 'users.patronymic')
            ->join('users', 'patients.user_id', '=', 'users.id')
            ->get();

        return $patients;
    }

    public function findAll($fields = [], $paginate = true)
    {
        if (empty($fields)) {
            $fields = ['users.*', 'patients.*'];
        }

        $query = QueryBuilder::for(Patient::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::custom('search', new FiltersUserSearch()),
            ]);

        $query = $query
            ->join('users', 'patients.user_id', '=', 'users.id');

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
            'patients.id', 'patients.sex'];

        $query = QueryBuilder::for(Patient::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::custom('search', new FiltersUserSearch()),
            ]);

        $result = $query
            ->join('users', 'patients.user_id', '=', 'users.id')
            ->paginate(15);

        return $result;
    }

    public function findById($id)
    {
        try {
            $patient = Patient::select('users.*', 'patients.*')
                ->join('users', 'patients.user_id', '=', 'users.id')
                ->where('patients.id', '=', $id)
                ->firstOrFail();
        }
        catch (\Exception $e) {
            dd($e);
        }

        return $patient;
    }

    public function findByUserId($id)
    {
        try {
            $patient = Patient::select('users.*', 'patients.*')
                ->join('users', 'patients.user_id', '=', 'users.id')
                ->where('users.id', '=', $id)
                ->firstOrFail();
        }
        catch (\Exception $e) {
            dd($e);
        }

        return $patient;
    }

    public function create(array $data) : Patient
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

            $patient = Patient::create([
                'address' => $data['address'],
                'sex' => $data['sex'],
                'allergies' => $data['allergies'],
                'user_id' => $user->id,
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

        return $patient;
    }

    public function update(array $data, Patient $patient): Patient
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

            $user = User::where('id', $patient->user_id)->update($userData);

            $patientData = array();
            if (array_key_exists('address', $data))
                $patientData['address'] = $data['address'];
            if (array_key_exists('sex', $data))
                $patientData['sex'] = $data['sex'];
            if (array_key_exists('allergies', $data))
                $patientData['allergies'] = $data['allergies'];

            Patient::where('id', $patient->id)->update($patientData);

            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            throw $e;
        }
        catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return $patient;
    }

    public function deleteById(int $id): void
    {
        $patient = Patient::find($id);
        $patient->delete();
    }
}
