<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class UpdateTaskRequest extends FormRequest
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
            "title" => "string",
            "description" => "string",
            "author_user_id" => "integer|exists:users,id",
            "assigned_user_id" => "integer|exists:users,id",
            "status_id" => "integer|exists:statuses,id",
            "parent_id" => "integer|exists:tasks,id"
        ];
    }


    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator): void
    {
        $response = new JsonResponse([
            'message' => 'Validation failed!',
            'errors' => $validator->errors(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
