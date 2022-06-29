<?php

namespace App\Dto;

use App\Interfaces\DtoInterface;
use Illuminate\Support\Arr;

class KinsmanDto implements DtoInterface
{
    /** @var int $id */
    public int $id;

    /** @var string|null $photo */
    public ?string $photo;

    /** @var string $name */
    public string $name;

    /** @var string|null $middle_name */
    public ?string $middle_name;

    /** @var string $gender */
    public string $gender;

    /** @var int|null $father_id */
    public ?int $father_id;

    /** @var int|null $mother_id */
    public ?int $mother_id;

    /** @var int|null $kin_id */
    public ?int $kin_id;

    /** @var string|null $birth_date */
    public ?string $birth_date;

    /** @var string|null $end_date */
    public ?string $end_date;

    /** @var string|null $city_name */
    public ?string $city_name;

    /** @var string|null $country_name */
    public ?string $country_name;

    /** @var string|null $native */
    public ?string $native;

    /** @var int|null $native_city_id */
    public ?int $native_city_id;

    /** @var int|null $partner_id */
    public ?int $partner_id;

    public function createFromRequest(array $fields): DtoInterface
    {
        $kinsman = Arr::has($fields, 'kinsman') ? Arr::get($fields, 'kinsman') : $fields;
        $life = Arr::has($fields, 'life') ? Arr::get($fields, 'life') : $fields;
        $marriage = Arr::has($fields, 'marriage') ? Arr::get($fields, 'marriage') : $fields;
        $city = Arr::get($fields, 'city');
        $array = array_merge($kinsman, $life, $marriage);

        foreach (get_class_vars(self::class) as $prop => $item) {
            if (Arr::has($array, $prop)) {
                $this->$prop = Arr::get($array, $prop);
            }
        }

        if (!empty($city)) {
            $this->city_name = Arr::get($city, 'city_name');
            $this->country_name = Arr::get($city, 'country_name');
            $this->native = json_encode(Arr::get($city, 'native'));
        }

        return $this;
    }
}
