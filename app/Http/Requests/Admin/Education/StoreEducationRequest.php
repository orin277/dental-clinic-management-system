<?php

namespace App\Http\Requests\Admin\Education;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreEducationRequest extends FormRequest
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
            'name_of_institution' => 'required|string|max:100',
            'graduation_year' => 'required|integer',
            'dentist_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name_of_institution.required' => 'Поле назва обов\'язкове для заповнення',
            'name_of_institution.string' => 'Поле назва повинно бути рядком',
            'name_of_institution.max' => 'Поле назва не повинно перевищувати 100 символів',
            'graduation_year.required' => 'Поле рік випуску обов\'язкове для заповнення',
            'graduation_year.integer' => 'Поле рік випуску повинно бути числом',
            'dentist_id.required' => 'Поле стоматолог обов\'язкове для заповнення',
        ];
    }
}
