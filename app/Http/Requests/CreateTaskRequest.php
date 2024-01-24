<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class CreateTaskRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "title" => "required|string",
            "description" => "required|string",
            "author_user_id" => "required|integer|exists:users,id",
            "assigned_user_id" => "required|integer|exists:users,id",
            "status_id" => "required|integer|exists:statuses,id",
            "parent_id" => "nullable|integer|exists:tasks,id"
        ];
    }


    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator): void
    {
        $response = response()->json([
            'message' => 'Validation failed!',
            'errors' => $validator->errors(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
