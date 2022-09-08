<?php

namespace App\Http\Requests;

use App\Dto\DateDto;
use App\Interfaces\DtoInterface;
use App\Interfaces\TransportInterface;
use JetBrains\PhpStorm\ArrayShape;

class DateRequest extends BaseRequest implements TransportInterface
{
    #[ArrayShape([
        'begin' => "string",
        'end' => "string"
    ])]
    public function rules(): array
    {
        return [
            'begin' => 'bail|required|string',
            'end' => 'bail|required|string',
        ];
    }

    public function createDto(): DtoInterface
    {
        return app(DateDto::class)->createFromRequest($this->validated());
    }
}
