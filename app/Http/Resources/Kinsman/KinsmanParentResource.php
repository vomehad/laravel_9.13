<?php

namespace App\Http\Resources\Kinsman;

use App\Http\Resources\Kin\KinResource;
use App\Http\Resources\Life\LifeResource;
use App\Models\Kinsman;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KinsmanParentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Kinsman $this */
        return [
            "id" => $this->id,
            "name" => $this->name,
            "middle_name" => $this->middle_name,
            "kin" => new KinResource($this->kin),
            "life" => new LifeResource($this->life),
        ];
    }
}
