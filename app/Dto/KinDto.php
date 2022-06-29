<?php

namespace App\Dto;

use App\Interfaces\DtoInterface;
use Illuminate\Support\Arr;

class KinDto implements DtoInterface
{
    public int $id;
    public string $name;
    public string $color;
    public bool $active;
    public int $created_by;

    public function createFromRequest(array $fields): DtoInterface
    {
        $array = Arr::has($fields, 'kin') ? Arr::get($fields, 'kin') : $fields;

        foreach (get_class_vars(self::class) as $prop => $item) {
            if (Arr::has($array, $prop)) {
                $this->$prop = Arr::get($array, $prop);
            }
        }

        return $this;
    }
}
