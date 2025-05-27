<?php

namespace App\Http\Requests\Admin\Treatment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTreatmentRequest extends FormRequest
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
            'diagnosis' => 'string|max:100',
            'treatment_description' => 'string|max:300',
            'appointment_id' => 'integer',
            'tooth_id' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'diagnosis.required' => 'Поле діагноз обов\'язкове для заповнення',
            'diagnosis.string' => 'Поле діагноз повинно бути рядком',
            'diagnosis.max' => 'Поле діагноз не повинно перевищувати 100 символів',
            'treatment_description.required' => 'Поле опис лікування обов\'язкове для заповнення',
            'treatment_description.string' => 'Поле опис лікування повинно бути рядком',
            'treatment_description.max' => 'Поле опис лікування не повинно перевищувати 300 символів',
            'appointment_id.required' => 'Поле прийом обов\'язкове для заповнення',
            'tooth_id.required' => 'Поле зуб обов\'язкове для заповнення',
        ];
    }
}
