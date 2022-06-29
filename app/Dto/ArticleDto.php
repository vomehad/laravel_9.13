<?php

namespace App\Dto;

use App\Interfaces\DtoInterface;
use Illuminate\Support\Arr;

class ArticleDto implements DtoInterface
{
    /** @var int $id */
    public int $id;

    /** @var string $title */
    public string $title;

    /** @var string|null $preview */
    public ?string $preview;

    /** @var string|null $linnk */
    public ?string $link;

    /** @var bool $active */
    public bool $active;

    /** @var array $category */
    public array $category;

    /** @var int $created_by */
    public int $created_by;

    /** @var string $text */
    public string $text;

    /** @var string|null $disk */
    public ?string $disk;

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
