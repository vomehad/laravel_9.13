<?php

namespace App\Http\Resources\Life;

use App\Models\Life;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LifeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Life $this */
        return [
            "id" => $this->id,
            "birth_date" => $this->birth_date,
            "end_date" => $this->end_date,
            "native_city_id" => $this->native,
//            "created_at" => $this->created_at,
//            "updated_at" => $this->updated_at,
//            "active" => $this->active,
//            "deleted_at" => $this->deleted_at,
        ];
    }
}
