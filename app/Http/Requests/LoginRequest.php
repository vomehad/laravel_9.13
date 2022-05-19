<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use JetBrains\PhpStorm\ArrayShape;

class LoginRequest extends FormRequest
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
    #[ArrayShape(['email' => "string", 'password' => "array"])]
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => ['required', Password::min(8)->letters()->numbers()->symbols()],
        ];
    }
}
