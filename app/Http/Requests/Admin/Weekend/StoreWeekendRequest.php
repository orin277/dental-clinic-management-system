<?php

namespace App\Http\Requests\Admin\Weekend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreWeekendRequest extends FormRequest
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
            'day' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'day.required' => 'Поле день обов\'язкове для заповнення',
            'day.date' => 'Поле день повинно бути датою',
        ];
    }
}
