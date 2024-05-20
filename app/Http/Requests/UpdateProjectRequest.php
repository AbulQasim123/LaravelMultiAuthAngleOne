<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'edit_project_name' => 'required',
            'edit_start_date' => 'required',
            'edit_dead_line' => 'required',
            'edit_client_id' => 'required',
            'edit_project_cost' => 'required',
            'edit_project_budget' => 'required',
            // 'edit_summary' => 'required',
            // 'edit_notes' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'edit_project_name.required' => 'Project Name is required',
            'edit_start_date.required' => 'Start Date is required',
            'edit_dead_line.required' => 'Dead Line is required',
            'edit_client_id.required' => 'Client Name is required',
            'edit_project_cost.required' => 'Project Cost is required',
            'edit_project_budget.required' => 'Project Budget is required',
            // 'edit_summary.required' => 'Summary is required',
            // 'edit_notes.required' => 'Notes is required',
        ];
    }
}
