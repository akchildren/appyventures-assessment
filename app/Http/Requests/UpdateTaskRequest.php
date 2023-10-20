<?php

namespace App\Http\Requests;

use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:150'
            ],
            'description' => [
                'required',
                'string'
            ],
            'due_date' => [
                'required',
                'date',
            ],
            'status' => [
                'nullable',
                'string',
                new Enum(TaskStatus::class)
            ]
        ];
    }
}
