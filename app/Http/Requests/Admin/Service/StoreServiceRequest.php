<?php

namespace App\Http\Requests\Admin\Service;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreServiceRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'price' => 'required|numeric',
            'type_of_service_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле назва обов\'язкове для заповнення',
            'name.string' => 'Поле назва повинно бути рядком',
            'name.max' => 'Поле назва не повинно перевищувати 50 символів',
            'price.required' => 'Поле ціна обов\'язкове для заповнення',
            'price.numeric' => 'Поле ціна повинно бути числом',
            'type_of_service_id.required' => 'Поле тип послуги обов\'язкове для заповнення',
        ];
    }
}
