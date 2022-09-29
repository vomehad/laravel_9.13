<?php

namespace App\Http\Requests;

use App\Dto\PhotoDto;
use JetBrains\PhpStorm\ArrayShape;

class CreatePhotoRequest extends BaseRequest
{
    #[ArrayShape([
        'name' => "string",
        'file' => "string"
    ])]
    public function rules(): array
    {
        return [
            'name' => 'required',
            'file' => 'required',
        ];
    }

    public function createDto(): PhotoDto
    {
        return app(PhotoDto::class)->createFromRequest($this->validated());
    }
}
