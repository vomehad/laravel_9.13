<?php

namespace App\Http\Requests;

use App\Dto\CityDto;
use JetBrains\PhpStorm\ArrayShape;

class UpdateCityRequest extends BaseRequest
{
    #[ArrayShape([
        'city.id' => "string",
        'city.name' => "string",
        'city.country' => "string",
        'city.modern_name' => "string",
        'city.active' => "string"
    ])]
    public function rules(): array
    {
        return [
            'city.id' => 'exists:cities,id',
            'city.name' => 'required|string',
            'city.country' => 'required|string',
            'city.modern_name' => 'nullable|string',
//            'city.life' => 'nullable|exists:life,id',
            'city.active' => 'bool',
        ];
    }

    public function createDto(): CityDto
    {
        return app(CityDto::class)->createFromRequest($this->validated());
    }

}
