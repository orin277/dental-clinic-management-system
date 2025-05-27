<?php

namespace App\Http\Requests\Dentist\Schedule;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateScheduleRequest extends FormRequest
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
            'start_time' => 'date_format:H:i',
            'end_time' => 'date_format:H:i',
            'day_of_week_id' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'start_time.required' => 'Поле початок обов\'язкове для заповнення',
            'start_time.date_format' => 'Поле початок повинно бути у форматі год:хв',
            'end_time.required' => 'Поле кінець обов\'язкове для заповнення',
            'end_time.date_format' => 'Поле кінець повинно бути у форматі год:хв',
            'day_of_week_id.required' => 'Поле день тижня обов\'язкове для заповнення',
        ];
    }
}
