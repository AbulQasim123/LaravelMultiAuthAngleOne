<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
        $rules = [
            'edit_title_name' => 'required|string|min:3|max:50',
            'edit_client_id' => 'required',
            'edit_project_id' => 'required',
            'edit_start_date' => 'required',
            'edit_due_date' => 'required',
            // 'edit_description' => 'required',
        ];

        if ($this->routeIs('update-task')) {
            $rules['edit_employee_id'] = 'required';
        }
        return $rules;
    }
    public function messages(): array
    {
        return [
            'edit_title_name.required' => 'Title is required',
            'edit_client_id.required' => 'Client name is required',
            'edit_project_id.required' => 'Project name is required',
            'edit_employee_id.required' => 'Employee name is required',
            'edit_start_date.required' => 'Start date is required',
            'edit_due_date.required' => 'Due date is required',
            // 'edit_description.required' => 'Description is required',
        ];
    }
}
