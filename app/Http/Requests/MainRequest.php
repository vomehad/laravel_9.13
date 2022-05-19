<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class MainRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape([
        'username' => "string",
        'name' => "string",
        'email' => "string",
        'subject' => "string",
        'message' => "string"
    ])]
    public function rules(): array
    {
        return [
            'username' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ];
    }

    #[ArrayShape(['name' => "string"])]
    public function attributes(): array
    {
        return [
            'name' => 'NAME',
        ];
    }

    #[ArrayShape(['email.required' => "string"])]
    public function messages(): array
    {
        return [
            'email.required' => 'fill email input',
        ];
    }
}
