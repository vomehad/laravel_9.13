<?php

namespace App\Dto;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property string $property
 * @property string $direction
 */
class SortKinsmansDto
{
    public string $direction;
    public Builder|string $property;

    public function serPropertyName(string $name)
    {
        if ($this->direction === 'desc') {
            $this->property = $this->prepareRelation(explode('-', $name)[1]);
        } else {
            $this->property = $this->prepareRelation($name);
        }
    }

    private function prepareRelation(string $name): string
    {
        return match ($name) {
            'id' => "id",
            default => "id",
        };
    }
}
