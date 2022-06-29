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
            'id' =>             $this->id,
            'photo' =>          new PhotoResource($this->presenter()->imageInfo()),
            'full_name' =>      $this->presenter()->title(),
//            'name' =>           $this->name,
//            'middle_name' =>    $this->middle_name,
            'kin' =>            new KinResource($this->kin),
//            'father' =>         new KinsmanParentResource($this->father),
//            'mother' =>         new KinsmanParentResource($this->mother),
            'life' =>           new LifeResource($this->life),
            'gender' =>         $this->presenter()->gender(),
//            'wed' =>            $this->presenter()->wed(),
//            'ex_wed' =>         new KinsmanWedResource($this->presenter()->wed()),
        ];
    }
}
