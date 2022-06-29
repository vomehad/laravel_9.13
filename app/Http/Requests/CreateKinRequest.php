<?php

namespace App\Http\Requests;

use App\Dto\KinDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateKinRequest extends FormRequest
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
            'kin.name' => 'required|string|min:3',
            'kin.color' => 'required|string',
            'kin.active' => 'bool',
        ];
    }

    public function createDto(): KinDto
    {
        return app(KinDto::class)->createFromRequest($this->validated());
    }
}
