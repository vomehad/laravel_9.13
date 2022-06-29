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
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Kin $this */
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
//            "active" => $this->active,
//            "created_at" => $this->created_at,
//            "updated_at" => $this->updated_at,
//            "deleted_at" => $this->deleted_at,
        ];
    }
}
