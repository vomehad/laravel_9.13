<?php

namespace App\Http\Requests;

use App\Dto\CookieDto;
use App\Interfaces\TransportInterface;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property int $numberHourly
 * @property int $numberForever
 */
class CreateCookieRequest extends BaseRequest implements TransportInterface
{
    #[ArrayShape([
        'numberHourly' => "array",
        'numberForever' => "array"
    ])]
    public function rules(): array
    {
        return [
            'numberHourly' => [
                'nullable',
                Rule::requiredIf(empty($this->numberForever)),
                'int',
                'max:255',
            ],
            'numberForever' => [
                'nullable',
                Rule::requiredIf(empty($this->numberHourly)),
                'int',
                'max:255',
            ],
        ];
    }

    public function createDto(): CookieDto
    {
        return app(CookieDto::class)->createFromRequest($this->validated());
    }
}
