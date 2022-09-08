<?php

namespace App\Http\Requests;

use JetBrains\PhpStorm\ArrayShape;

class MainRequest extends BaseRequest
{
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
            'message' => 'required',
        ];
    }

    #[ArrayShape([
        'name' => "string"
    ])]
    public function attributes(): array
    {
        return [
            'name' => 'NAME',
        ];
    }

    #[ArrayShape([
        'email.required' => "string"
    ])]
    public function messages(): array
    {
        return [
            'email.required' => 'fill email input',
        ];
    }
}
