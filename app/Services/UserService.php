<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class UserService
{
    public function update(array $data, User $user): void {
        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->patronymic = $data['patronymic'];
        $user->phone = $data['phone'];
        $user->date_of_birth = $data['date_of_birth'];
        $user->email = $data['email'];

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if (isset($data['avatar'])) {
            Storage::disk('public')->delete('avatars/' . $user->avatar);

            $filename = $user->id . time() . '.' . $data['avatar']->getClientOriginalExtension();
            Image::read($data['avatar'])->resize(512, 512)
                ->save(public_path('storage/avatars/' . $filename));
            $user->avatar = $filename;
        }

        $user->save();
    }

    public function delete(User $user): void {
        $user->delete();
    }
}
