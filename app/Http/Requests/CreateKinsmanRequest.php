<?php

namespace App\Http\Requests;

use App\Dto\KinsmanDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateKinsmanRequest extends FormRequest
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
            'kinsman.name' => 'required|string|min:3',
            'kinsman.middle_name' => 'nullable|string',
            'kinsman.gender' => 'required|in:male,female',
            'kinsman.father_id' => 'nullable|exists:kinsmans,id',
            'kinsman.mother_id' => 'nullable|exists:kinsmans,id',
            'kinsman.kin_id' => 'nullable|exists:kins,id',

            'life.birth_date' => 'nullable|string',
            'life.end_date' => 'nullable|string',

            'city.city_name' => 'nullable|string',
            'city.country_name' => 'nullable|string',
            'city.native' => 'nullable',

            'marriage.partner_id' => 'nullable|exists:kinsmans,id',
        ];
    }

    public function createDto(): KinsmanDto
    {
        return app(KinsmanDto::class)->createFromRequest($this->validated());
    }
}
