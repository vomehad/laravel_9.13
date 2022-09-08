<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property int $numberHourly
 * @property int $numberForever
 */
class AjaxRequest extends BaseRequest
{
    #[ArrayShape([
        'numberHourly' => "array",
        'numberForever' => "array"
    ])]
    public function rules(): array
    {
        return [
            'numberHourly' => [
                'bail',
                'nullable',
                Rule::requiredIf(empty($this->numberForever)),
                'int',
                'max:255',
            ],
            'numberForever' => [
                'bail',
                'nullable',
                Rule::requiredIf(empty($this->numberHourly)),
                'int',
                'max:255',
            ],
        ];
    }
}
