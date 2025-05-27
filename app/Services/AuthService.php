<?php

namespace App\Services;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data) : User
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
                'avatar' => 'user.png'
            ]);

            $patient = Patient::create([
                'address' => '',
                'sex' => $data['sex'],
                'user_id' => $user->id,
            ]);

            $user->assignRole('patient');

            event(new Registered($user));

            Auth::login($user);

            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
        }
        catch (\Exception $e) {
            DB::rollback();
        }

        return $user;
    }
}
