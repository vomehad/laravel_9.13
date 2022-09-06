<?php

namespace App\Http\Resources\Kin;

use App\Models\Kin;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KinResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Kin $this */
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
        ];
    }
}
