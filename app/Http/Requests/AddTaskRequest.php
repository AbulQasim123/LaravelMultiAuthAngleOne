<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTaskRequest extends FormRequest
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
            'title_name' => 'required|string|min:3|max:50',
            'project_id' => 'required',
            'client_id' => 'required',
            'start_date' => 'required',
            'due_date' => 'required',
            // 'description' => 'required',
        ];
        if ($this->routeIs('add-task')) {
            $rules['employee_id'] = 'required';
        }

        return $rules;
    }
    public function messages(): array
    {
        return [
            'title_name.required' => 'Title is required',
            'project_id.required' => 'Project name is required',
            'client_id.required' => 'Client name is required',
            'employee_id.required' => 'Employee name is required',
            'start_date.required' => 'Start date is required',
            'due_date.required' => 'Due date is required',
            // 'description.required' => 'Description is required',
        ];
    }
}
