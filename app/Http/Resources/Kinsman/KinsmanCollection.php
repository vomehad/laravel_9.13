<?php

namespace App\Http\Resources\Kinsman;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class KinsmanCollection extends ResourceCollection
{
    public $collects = KinsmanResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return Collection
     */
    public function toArray($request): Collection
    {
        return $this->collection;
    }
}
