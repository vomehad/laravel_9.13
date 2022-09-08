<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    /**
     * Можно тут проверить авторизацию пользователя
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Перечисляем правила валидации
     *
     * @return array
     */
    public function rules(): array
    {
        return [

        ];
    }

    /**
     * Тут можно переименовать атрибуты в сообщениях ошибок валидации
     *
     * @return array
     */
    public function attributes(): array
    {
        return [

        ];
    }

    /**
     * Тут полностью меняем текст сообщения
     *
     * @return array
     */
    public function messages(): array
    {
        return [

        ];
    }
}
