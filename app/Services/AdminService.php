<?php

namespace App\Services;

use App\Http\Filters\FiltersUserSearch;
use App\Models\Dentist;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AdminService
{
    public function findAll()
    {
        $fields = ['users.*'];

        $result = QueryBuilder::for(User::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::custom('search', new FiltersUserSearch()),
            ])
            ->isAdmin()
            ->paginate(15);

        return $result;
    }

    public function findById($id)
    {
        $dentist = User::select('users.*')
            ->where('users.id', '=', $id)
            ->where('users.is_admin', '=', true)
            ->firstOrFail();

        return $dentist;
    }

    public function create(array $data) : User
    {
        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'patronymic' => $data['patronymic'],
            'phone' => $data['phone'],
            'date_of_birth' => $data['date_of_birth'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_admin' => true,
        ]);

        return $user;
    }

    public function update(array $data, User $user): User
    {
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

        User::where('id', $user->id)->update($userData);

        return $user;
    }

    public function deleteById(int $id): void
    {
        $user = User::find($id);
        $user->delete();
    }
}
