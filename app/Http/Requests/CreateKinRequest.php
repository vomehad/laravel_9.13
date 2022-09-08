<?php

namespace App\Http\Requests;

use App\Dto\KinDto;
use JetBrains\PhpStorm\ArrayShape;

class CreateKinRequest extends BaseRequest
{
    #[ArrayShape([
        'kin.name' => "string",
        'kin.color' => "string",
        'kin.active' => "string"
    ])]
    public function rules(): array
    {
        return [
            'kin.name' => 'required|string|min:3',
            'kin.color' => 'required|string',
            'kin.active' => 'bool',
        ];
    }

    public function createDto(): KinDto
    {
        return app(KinDto::class)->createFromRequest($this->validated());
    }
}
