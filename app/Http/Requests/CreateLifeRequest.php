<?php

namespace App\Http\Requests;

use App\Dto\LifeDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateLifeRequest extends FormRequest
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
            'kinsman_id' => 'required_if:life.kinsman_id,null|int|exists:kinsmans,id',
            'life.kinsman_id' => 'required_if:kinsman_id,null|int|exists:kinsmans,id',

            'birth_date' => 'required_if:life.birth_date,null|string',
            'life.birth_date' => 'required_if:birth_date,null|string',

            'end_date' => 'nullable|string',
            'life.end_date' => 'nullable|string',

            'active' => 'nullable|bool',
            'life.active' => 'nullable|bool',
        ];
    }

    public function createDto(): LifeDto
    {
        return app(LifeDto::class)->createFromRequest($this->validated());
    }
}
