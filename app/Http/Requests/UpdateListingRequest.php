<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateListingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'salary' => ['required', 'string', 'max:45'],
            'requirements' => ['nullable', 'string'],
            'benefits' => ['nullable', 'string'],
            'tags' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:45'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:45'],
            'state' => ['required', 'string', 'max:45'],
            'phone' => ['nullable', 'string', 'max:45'],
            'email' => ['required', 'email', 'max:45'],
        ];
    }
}
