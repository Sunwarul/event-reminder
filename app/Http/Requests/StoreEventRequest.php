<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'event_id' => ['required', 'string', 'max:255', 'unique:events,event_id'],
            'name' => ['required', 'string', 'max:255'],
            'start_time' => ['required', 'date', 'before_or_equal:end_time'],
            'end_time' => ['required', 'date', 'after_or_equal:start_time'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'organizer' => ['nullable', 'string', 'max:255'],
            'type' => ['nullable', 'in:conference,webinar,meeting,workshop,seminar,other'],
            'url' => ['nullable', 'url', 'max:255'],
            'image' => ['nullable', 'string', 'max:255'],
            'created_by' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:scheduled,ongoing,complete'],
        ];
    }
}
