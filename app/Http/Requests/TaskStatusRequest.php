<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStatusRequest extends FormRequest
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
            'name' => 'required|unique:task_statuses,name',
        ];
    }

    /**
     * Summary of messages
     * @return array
     */
    public function messages(): array
    {
        return [
            '*.required' => 'This is a required field',
            'name.unique' => 'A status with this name already exists',
        ];
    }
}
