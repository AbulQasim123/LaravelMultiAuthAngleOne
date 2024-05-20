<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:25',
            'email' => 'required|email|unique:clients,email',
            'contact' => 'required|numeric|digits:10',
            'gender' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Name number is required.',
            'name.string' => 'Name must be a string.',
            'name.min' => 'Name must be at least 3 characters.',
            'name.max' => 'Name must be at most 25 characters.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email.',
            'email.unique' => 'Email already exists.',
            'contact.required' => 'Contact number is required.',
            'contact.numeric' => 'Contact number must be a number.',
            'contact.digits' => 'Contact number must be 10 digits.',
            'gender.required' => 'Gender is required.',
        ];
    }
}
