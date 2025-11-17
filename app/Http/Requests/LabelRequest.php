<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabelRequest extends FormRequest
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
            'name' => 'required|unique:labels,name',
            'description' => 'nullable|string',
        ];
    }

    /**
     * Summary of messages
     * @return array
     */
    public function messages(): array
    {
        return [
            '*.required' => __('validation.required'),
            'name.unique' => __('validation.label.unique'),
        ];
    }
}
