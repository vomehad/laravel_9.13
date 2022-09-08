<?php

namespace App\Http\Requests;

use App\Dto\KinDto;
use JetBrains\PhpStorm\ArrayShape;

class UpdateKinRequest extends BaseRequest
{
    #[ArrayShape([
        'kin.id' => "string",
        'kin.name' => "string",
        'kin.color' => "string",
        'kin.active' => "string"
    ])]
    public function rules(): array
    {
        return [
            'kin.id' => 'exists:kins,id',
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
