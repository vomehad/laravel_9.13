<?php

namespace App\Http\Resources\Kinsman;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class PhotoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => Arr::get($this, 'id'),
            'name' => Arr::get($this, 'name'),
            'original_name' => Arr::get($this, 'original_name'),
            'mime' => Arr::get($this, 'mime'),
            'extension' => Arr::get($this, 'extension'),
            'size' => Arr::get($this, 'size'),
            'path' => Arr::get($this, 'path'),
            'disk' => Arr::get($this, 'disk'),
            'url' => Arr::get($this, 'url'),
            'relativeUrl' => Arr::get($this, 'relativeUrl'),
        ];
    }
}
