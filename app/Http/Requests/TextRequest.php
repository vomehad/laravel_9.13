<?php

namespace App\Http\Requests;

use App\Dto\ExamDto;
use App\Interfaces\DtoInterface;
use App\Interfaces\TransportInterface;
use Illuminate\Foundation\Http\FormRequest;

class TextRequest extends FormRequest implements TransportInterface
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
            //
        ];
    }

    public function createDto(): DtoInterface
    {
        $dto = new ExamDto();
        $dto->text = $this->text;

        return $dto;
    }
}
