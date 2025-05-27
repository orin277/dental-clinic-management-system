<?php

namespace App\Http\Requests\Admin\Appointment;

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
            'reason' => 'string|max:300',
            'date' => 'date',
            'start_time' => 'date_format:H:i',
            'end_time' => 'date_format:H:i',
            'dentist_id' => 'integer',
            'patient_id' => 'integer',
            'appointment_status_id' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'reason.required' => 'Поле причина звернення обов\'язкове для заповнення',
            'reason.string' => 'Поле причина звернення повинно бути рядком',
            'reason.max' => 'Поле причина звернення не повинно перевищувати 300 символів',
            'date.required' => 'Поле дата обов\'язкове для заповнення',
            'date.string' => 'Поле дата повинно бути датою',
            'start_time.required' => 'Поле початок обов\'язкове для заповнення',
            'start_time.date_format' => 'Поле початок повинно бути у форматі год:хв',
            'end_time.required' => 'Поле кінець обов\'язкове для заповнення',
            'end_time.date_format' => 'Поле кінець повинно бути у форматі год:хв',
            'dentist_id.required' => 'Поле стоматолог обов\'язкове для заповнення',
            'patient_id.required' => 'Поле пацієнт обов\'язкове для заповнення',
            'appointment_status_id.required' => 'Поле статус прийому обов\'язкове для заповнення',
        ];
    }
}
