<?php

namespace App\Http\Requests;

use App\Dto\ExamDto;
use App\Interfaces\DtoInterface;
use App\Interfaces\TransportInterface;
use JetBrains\PhpStorm\Pure;

class TextRequest extends BaseRequest implements TransportInterface
{

    #[Pure]
    public function createDto(): DtoInterface
    {
        $dto = new ExamDto();
        $dto->text = $this->text;

        return $dto;
    }
}
