<?php

namespace App\Http\Requests;

use App\Dto\CookieDto;
use App\Interfaces\TransportInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property int $numberHourly
 * @property int $numberForever
 */
class CreateCookieRequest extends FormRequest implements TransportInterface
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
