<?php

namespace App\Dto;

use App\Interfaces\DtoInterface;
use Illuminate\Support\Arr;

class LifeDto implements DtoInterface
{
    public int $id;
    public ?int $kinsman_id;
    public ?string $birth_date;
    public ?string $end_date;
    public bool $active;

    /** @var int|null $native_city_id */
    public ?int $native_city_id;

    public function createFromRequest(array $fields): DtoInterface
    {
        $array = is_array(reset($fields)) ? reset($fields) : $fields;

        foreach (get_class_vars(self::class) as $prop => $item) {
            if (Arr::has($array, $prop)) {
                $this->$prop = Arr::get($array, $prop);
            }
        }

        return $this;
    }
}
