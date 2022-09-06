<?php

namespace App\Http\Resources\Kinsman;

use App\Http\Resources\Kin\KinResource;
use App\Http\Resources\Life\LifeResource;
use App\Models\Kinsman;
use Illuminate\Http\Resources\Json\JsonResource;

class KinsmanWedResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Kinsman $this */
        return [
            'id' => $this->id,
            'photo' => new PhotoResource($this->presenter()->imageInfo()),
            'full_name' => $this->presenter()->title(),
            'kin' => new KinResource($this->kin),
            'life' => new LifeResource($this->life),
            'gender' => $this->presenter()->gender(),
        ];
    }
}
