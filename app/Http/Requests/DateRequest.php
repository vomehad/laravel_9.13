<?php

namespace App\Http\Requests;

use App\Dto\DateDto;
use App\Interfaces\DtoInterface;
use App\Interfaces\TransportInterface;
use Illuminate\Foundation\Http\FormRequest;

class DateRequest extends FormRequest implements TransportInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'begin' => 'bail|required|string',
            'end' => 'bail|required|string',
        ];
    }

    public function createDto(): DtoInterface
    {
        return app(DateDto::class)->createFromRequest($this->validated());
    }
}
