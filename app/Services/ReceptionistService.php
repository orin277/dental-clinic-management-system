<?php

namespace App\Services;

use App\Http\Filters\FiltersUserSearch;
use App\Models\Patient;
use App\Models\Receptionist;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ReceptionistService
{
    public function findAll($fields = [], $paginate = true)
    {
        if (empty($fields)) {
            $fields = ['users.*', 'receptionists.*'];
        }

        $query = QueryBuilder::for(Receptionist::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::custom('search', new FiltersUserSearch()),
            ]);

        $query = $query
            ->join('users', 'receptionists.user_id', '=', 'users.id');

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
            'receptionists.id', 'receptionists.sex'];

        $query = QueryBuilder::for(Receptionist::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::custom('search', new FiltersUserSearch()),
            ]);

        $result = $query
            ->join('users', 'receptionists.user_id', '=', 'users.id')
            ->paginate(15);

        return $result;
    }

    public function findById($id)
    {
        $receptionist = Receptionist::select('users.*', 'receptionists.*')
            ->join('users', 'receptionists.user_id', '=', 'users.id')
            ->where('receptionists.id', '=', $id)
            ->firstOrFail();

        return $receptionist;
    }

    public function findByUserId($id)
    {
        $receptionist = Receptionist::select('users.*', 'receptionists.*')
            ->join('users', 'receptionists.user_id', '=', 'users.id')
            ->where('users.id', '=', $id)
            ->firstOrFail();

        return $receptionist;
    }

    public function create(array $data) : Receptionist
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

            $receptionist = Receptionist::create([
                'address' => $data['address'],
                'sex' => $data['sex'],
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

        return $receptionist;
    }

    public function update(array $data, Receptionist $receptionist): Receptionist
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

            $user = User::where('id', $receptionist->user_id)->update($userData);

            $receptionistData = array();
            if (array_key_exists('address', $data))
                $receptionistData['address'] = $data['address'];
            if (array_key_exists('sex', $data))
                $receptionistData['sex'] = $data['sex'];

            Receptionist::where('id', $receptionist->id)->update($receptionistData);

            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            throw $e;
        }
        catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return $receptionist;
    }

    public function deleteById(int $id): void
    {
        $receptionist = Receptionist::find($id);
        $receptionist->delete();
    }
}
