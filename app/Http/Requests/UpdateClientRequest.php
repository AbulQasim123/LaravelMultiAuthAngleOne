<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'edit_name' => 'required|string|min:3|max:25',
            'edit_email' => 'required|email',
            'edit_contact' => 'required|numeric|digits:10',
            'edit_gender' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'edit_name.required' => 'Name number is required.',
            'edit_name.string' => 'Name must be a string.',
            'edit_name.min' => 'Name must be at least 3 characters.',
            'edit_name.max' => 'Name must be at most 25 characters.',
            'edit_email.required' => 'Email is required.',
            'edit_email.email' => 'Email must be a valid email.',
            'edit_email.unique' => 'Email already exists.',
            'edit_contact.required' => 'Contact number is required.',
            'edit_contact.numeric' => 'Contact number must be a number.',
            'edit_contact.digits' => 'Contact number must be 10 digits.',
            'edit_gender.required' => 'Gender is required.',
        ];
    }
}
