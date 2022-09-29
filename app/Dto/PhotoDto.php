<?php

namespace App\Dto;

use App\Interfaces\DtoInterface;
use Illuminate\Support\Arr;

class PhotoDto implements DtoInterface
{
    /** @var int $id */
    public int $id;

    /** @var mixed $file */
    public mixed $file;

    /** @var string $name */
    public string $name;

    public function createFromRequest(array $fields): DtoInterface
    {
        foreach (get_class_vars(self::class) as $prop => $item) {
            if (Arr::has($fields, $prop)) {
                $this->$prop = Arr::get($fields, $prop);
            }
        }

        return $this;
    }
}
