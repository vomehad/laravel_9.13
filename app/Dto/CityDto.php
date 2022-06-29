<?php

namespace App\Dto;

use App\Interfaces\DtoInterface;
use Illuminate\Support\Arr;

class CityDto implements DtoInterface
{
    /** @var int $id */
    public int $id;

    /** @var string|null $name */
    public ?string $name;

    /** @var string|null $country */
    public ?string $country;

    /** @var string|null $modern_name */
    public ?string $modern_name;

    /** @var string|null $geo */
    public ?string $geo;

    /** @var boolean $active */
    public ?bool $active;

    public function createFromRequest(array $fields): DtoInterface
    {
        $city = Arr::has($fields, 'city') ? Arr::get($fields, 'city') : $fields;

        foreach (get_class_vars(self::class) as $prop => $item) {
            if (Arr::has($city, $prop)) {
                $this->$prop = Arr::get($city, $prop);
            }
        }

        return $this;
    }
}
