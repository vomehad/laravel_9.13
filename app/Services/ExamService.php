<?php

namespace App\Services;

use App\Interfaces\DtoInterface;

class ExamService
{
    public function splitWordByChars(DtoInterface $dto): string
    {
        $split = '';

        for ($char = 0; $char < mb_strlen($dto->wordSplit); $char++) {
            $split .= mb_substr($dto->wordSplit, $char, 1) . ' ';
        }

        return $split;
    }

    public function textWithReplacedDates(DtoInterface $dto)
    {
        $pattern = '/(\d{2})\.(\d{2})\.(\d{4})/';
        $replacement = '$1.$3.$2';

        return preg_replace($pattern, $replacement, $dto->text);
    }

    public function diffTwoDates($dto): array
    {
        $begin = date_create($dto->begin);
        $end = date_create($dto->end);
        $diff = $begin->diff($end);

        $days = $diff->days;
        $month = $diff->y > 0 ? ($diff->y * 12 + $diff->m) : $diff->m;
        $years = $diff->y;

        return [$begin, $end, $days, $month, $years];
    }
}
