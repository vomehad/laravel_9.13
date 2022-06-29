<?php

namespace App\Http\Requests;

use App\Dto\CityDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'city.id',
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
