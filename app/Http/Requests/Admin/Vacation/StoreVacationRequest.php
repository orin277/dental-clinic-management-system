<?php

namespace App\Http\Requests\Admin\Vacation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreVacationRequest extends FormRequest
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
            'start' => 'required|date',
            'end' => 'required|date',
            'dentist_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'start.required' => 'Поле початок обов\'язкове для заповнення',
            'start.date' => 'Поле діагноз повинно бути датою',
            'end.required' => 'Поле кінець обов\'язкове для заповнення',
            'end.date' => 'Поле кінець повинно бути датою',
            'dentist_id.required' => 'Поле стоматолог обов\'язкове для заповнення',
        ];
    }
}
