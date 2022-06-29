<?php

namespace App\Dto;

use App\Interfaces\DtoInterface;
use Illuminate\Support\Arr;

class CookieDto implements DtoInterface
{
    public ?int $numberHourly;
    public ?int $numberForever;

    public function createFromRequest(array $fields): DtoInterface
    {
        $array = is_array(reset($fields)) ? reset($fields) : $fields;

        foreach (get_class_vars(self::class) as $prop => $item) {
                $this->$prop = Arr::get($array, $prop);
        }

        return $this;
    }
}
