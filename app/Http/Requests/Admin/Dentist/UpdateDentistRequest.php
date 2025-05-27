<?php

namespace App\Http\Requests\Admin\Dentist;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateDentistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|max:30',
            'surname' => 'string|max:40',
            'patronymic' => 'string|max:30',
            'phone' => 'string|max:15',
            'date_of_birth' => 'date',
            'email' => 'email',
            'password' => 'string|max:255|min:8',
            'address' => 'string|max:100',
            'sex' => 'integer',
            'cabinet' => 'integer',
            'work_experience' => 'integer',
            'dentist_specialization_id' => 'integer',
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
            'password.required' => 'Поле пароль обов\'язкове для заповнення',
            'password.string' => 'Поле пароль повинно бути рядком',
            'password.min' => 'Пароль має бути не менше 8 символів',
            'password.max' => 'Пароль має бути не більше 30 символів',
            'address.string' => 'Поле адреса повинно бути рядком',
            'address.max' => 'Поле адреса не повинно перевищувати 100 символів',
            'cabinet.integer' => 'Поле кабінет повинно бути числовим',
            'cabinet.required' => 'Поле кабінет обов\'язкове для заповнення',
            'work_experience.integer' => 'Поле досвід роботи повинно бути числовим',
            'work_experience.required' => 'Поле досвід роботи обов\'язкове для заповнення',
            'dentist_specialization_id.required' => 'Поле освіта стоматолога обов\'язкове для заповнення',
        ];
    }
}
