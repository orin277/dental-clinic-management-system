<?php

namespace App\Http\Requests\Dentist\Appointment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAppointmentRequest extends FormRequest
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
            'reason' => 'required|string|max:300',
            'appointment_status_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'reason.required' => 'Поле причина звернення обов\'язкове для заповнення',
            'reason.string' => 'Поле причина звернення повинно бути рядком',
            'reason.max' => 'Поле причина звернення не повинно перевищувати 300 символів',
            'appointment_status_id.required' => 'Поле статус обов\'язкове для заповнення',
        ];
    }
}
