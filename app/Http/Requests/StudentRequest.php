<?php

namespace App\Http\Requests;

use App\Models\Student;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //Route auth middleware overrides this
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['numeric', 'digits:8'],
            'first_name' => 'string|max:30',
            'last_name' => 'string|max:30',
            'degree' => 'numeric|exists:degrees,id'
        ];
    }
}
