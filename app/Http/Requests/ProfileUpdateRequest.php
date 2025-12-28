<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:30',
            'surname' => 'required|string|max:40',
            'patronymic' => 'required|string|max:30',
            'phone' => 'required|string|max:15',
            'date_of_birth' => 'required|date',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'avatar' => 'image',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле ім\'я обов\'язкове для заповнення',
            'name.string' => 'Поле ім\'я повинно бути рядком',
            'name.max' => 'Поле ім\'я не повинно перевищувати 30 символів',
            'surname.required' => 'Поле прізвище обов\'язкове для заповнення',
            'surname.string' => 'Поле прізвище повинно бути рядком',
            'surname.max' => 'Поле прізвище не повинно перевищувати 40 символів',
            'patronymic.required' => 'Поле по батькові обов\'язкове для заповнення',
            'patronymic.string' => 'Поле по батькові повинно бути рядком',
            'patronymic.max' => 'Поле по батькові не повинно перевищувати 30 символів',
            'phone.required' => 'Поле номер телефону обов\'язкове для заповнення',
            'phone.string' => 'Поле номер телефону повинно бути рядком',
            'phone.max' => 'Поле номер телефону не повинно перевищувати 15 символів',
            'date_of_birth.required' => 'Поле дата народження обов\'язкове для заповнення',
            'date_of_birth.date' => 'Поле дата народження повинно бути датою',
            'email.required' => 'Поле email обов\'язкове для заповнення',
            'email.email' => 'Введіть дійсну адресу електронної пошти.',
            'email.unique' => 'Даний email вже використовується',
            'avatar.image' => 'Фото профілю повинно бути зображенням',
        ];
    }
}
