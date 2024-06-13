<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
            'title' => 'required|string|min:3',
            'description' => 'required|string',
            'is_virtual' => 'required|boolean',
            'start_at' => 'required|date|after:tomorrow',
            'finish_at' => 'required|date|after:start_at',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
