<?php

namespace App\Http\Requests;

use JetBrains\PhpStorm\ArrayShape;

class NoteRequest extends BaseRequest
{
    #[ArrayShape([
        'name' => "string",
        'content' => "string"
    ])]
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'content' => 'string',
        ];
    }
}
