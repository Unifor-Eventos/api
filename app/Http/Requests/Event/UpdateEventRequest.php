<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'title' => 'sometimes|string|min:3',
            'description' => 'sometimes|string',
            'is_virtual' => 'sometimes|boolean',
            'start_at' => 'sometimes|date|after:tomorrow',
            'finish_at' => 'sometimes|date|after:start_at',
            'banner' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
