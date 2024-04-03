<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimeslotRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //Handled via route middleware
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'room_id' => 'string|exists:rooms,id',
            'day_of_week' => 'numeric|min:1,max:5',
            'start_time' => 'date_format:H:i',
            'end_time' => 'date_format:H:i|after:time_start',
            'is_lecture' => 'nullable'
        ];
    }
}
