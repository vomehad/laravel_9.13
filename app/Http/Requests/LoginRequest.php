<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use JetBrains\PhpStorm\ArrayShape;

class LoginRequest extends BaseRequest
{
    #[ArrayShape([
        'email' => "string",
        'password' => "array"
    ])]
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => ['required', Password::min(8)->letters()->numbers()->symbols()],
        ];
    }
}
