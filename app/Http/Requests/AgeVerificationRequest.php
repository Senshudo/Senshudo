<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgeVerificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'video' => ['required', 'string'],
            'date_of_birth' => [
                'required',
                'date_format:d-m-Y',
                'before:'.now()->subYears(18)->toDateString(),
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'date_of_birth.required' => 'Please enter your date of birth',
            'date_of_birth.date_format' => 'Please enter a valid date',
            'date_of_birth.before' => 'You must be at least 18 years old to view this video',
        ];
    }
}
