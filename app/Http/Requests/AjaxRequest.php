<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property int $numberHourly
 * @property int $numberForever
 */
class AjaxRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['numberHourly' => "array", 'numberForever' => "array"])]
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
