<?php

namespace App\Http\Requests;

use App\Dto\ExamDto;
use App\Interfaces\DtoInterface;
use App\Interfaces\TransportInterface;
use JetBrains\PhpStorm\ArrayShape;

class SplitRequest extends BaseRequest implements TransportInterface
{
    #[ArrayShape([
        'wordSplit' => "string"
    ])]
    public function rules(): array
    {
        return [
            'wordSplit' => 'required|string|min:2',
        ];
    }

    public function createDto(): DtoInterface
    {
        return app(ExamDto::class)->createFromRequest($this->validated());
    }
}
