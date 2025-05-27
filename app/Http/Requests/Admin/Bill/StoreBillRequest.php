<?php

namespace App\Http\Requests\Admin\Bill;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreBillRequest extends FormRequest
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
            'amount' => 'required|numeric|min:1|max:1000000',
            'date' => 'required|date',
            'appointment_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'Поле сума обов\'язкове для заповнення',
            'amount.numeric' => 'Поле сума повинно бути числом',
            'amount.min' => 'Поле сума повинно бути білше 1',
            'amount.max' => 'Поле сума повинно бути менше 1000000',
            'date.required' => 'Поле дата обов\'язкове для заповнення',
            'date.date' => 'Поле дата повинно бути у форматі дати',
            'appointment_id.required' => 'Поле прийом обов\'язкове для заповнення',
        ];
    }
}
