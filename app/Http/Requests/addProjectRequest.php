<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addProjectRequest extends FormRequest
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
            'project_name' => 'required',
            'start_date' => 'required',
            'dead_line' => 'required',
            'client_id' => 'required',
            'project_cost' => 'required',
            'project_budget' => 'required',
            // 'summary' => 'required',
            // 'notes' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'project_name.required' => 'Project Name is required',
            'start_date.required' => 'Start Date is required',
            'dead_line.required' => 'Dead Line is required',
            'client_id.required' => 'Client Name is required',
            'project_cost.required' => 'Project Cost is required',
            'project_budget.required' => 'Project Budget is required',
            // 'summary.required' => 'Summary is required',
            // 'notes.required' => 'Notes is required',
        ];
    }
}
