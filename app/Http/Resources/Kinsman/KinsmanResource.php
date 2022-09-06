<?php

namespace App\Http\Resources\Kinsman;

use App\Http\Resources\Kin\KinResource;
use App\Http\Resources\Life\LifeResource;
use App\Models\Kinsman;
use Illuminate\Http\Resources\Json\JsonResource;

class KinsmanResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Kinsman $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'middle_name' => $this->middle_name,
            'kin' => new KinResource($this->kin),
            'father' => new KinsmanParentResource($this->father),
            'mother' => new KinsmanParentResource($this->mother),
            'life' => new LifeResource($this->life),
            'gender' => $this->gender,
        ];
    }
}
