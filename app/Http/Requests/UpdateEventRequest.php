<?php

namespace App\Http\Requests;

use App\Enums\EventStatusEnum;
use App\Enums\EventTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

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
            // 'event_id' => ['required', 'string', 'max:255', 'unique:events,event_id'],
            'name' => ['required', 'string', 'max:255'],
            'start_time' => ['required', 'date', 'before_or_equal:end_time'],
            'end_time' => ['required', 'date', 'after_or_equal:start_time'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'organizer' => ['nullable', 'string', 'max:255'],
            'type' => ['nullable', new Enum(EventTypeEnum::class)],
            'url' => ['nullable', 'url', 'max:255'],
            'image' => ['nullable', 'image', 'mime:jpg,jpeg,png,gif', 'max:2048'], // Image validation
            'status' => ['required', new Enum(EventStatusEnum::class)],
        ];
    }
}
