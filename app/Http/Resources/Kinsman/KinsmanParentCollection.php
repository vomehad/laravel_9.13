<?php

namespace App\Http\Resources\Kinsman;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class KinsmanParentCollection extends ResourceCollection
{
    protected $collect = KinsmanSingleResource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection;
    }
}
