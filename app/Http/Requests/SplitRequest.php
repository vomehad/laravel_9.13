<?php

namespace App\Http\Requests;

use App\Dto\ExamDto;
use App\Interfaces\DtoInterface;
use App\Interfaces\TransportInterface;
use Illuminate\Foundation\Http\FormRequest;

class SplitRequest extends FormRequest implements TransportInterface
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
            'wordSplit' => 'required|string|min:2',
        ];
    }

    public function createDto(): DtoInterface
    {
        return app(ExamDto::class)->createFromRequest($this->validated());
    }
}
