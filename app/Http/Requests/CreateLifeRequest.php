<?php

namespace App\Http\Requests;

use App\Dto\LifeDto;
use JetBrains\PhpStorm\ArrayShape;

class CreateLifeRequest extends BaseRequest
{
    #[ArrayShape([
        'kinsman_id' => "string",
        'life.kinsman_id' => "string",
        'birth_date' => "string",
        'life.birth_date' => "string",
        'end_date' => "string",
        'life.end_date' => "string",
        'active' => "string",
        'life.active' => "string"
    ])]
    public function rules(): array
    {
        return [
            'kinsman_id' => 'required_if:life.kinsman_id,null|int|exists:kinsmans,id',
            'life.kinsman_id' => 'required_if:kinsman_id,null|int|exists:kinsmans,id',

            'birth_date' => 'required_if:life.birth_date,null|string',
            'life.birth_date' => 'required_if:birth_date,null|string',

            'end_date' => 'nullable|string',
            'life.end_date' => 'nullable|string',

            'active' => 'nullable|bool',
            'life.active' => 'nullable|bool',
        ];
    }

    public function createDto(): LifeDto
    {
        return app(LifeDto::class)->createFromRequest($this->validated());
    }
}
