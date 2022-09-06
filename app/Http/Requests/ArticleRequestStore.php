<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class ArticleRequestStore
 *
 * @package App\Http\Requests
 *
 * @property int $id
 * @property string $title
 */
class ArticleRequestStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
//        return auth()->check();
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['title' => "string", 'text' => "string", 'category.*' => "string"])]
    public function rules(): array
    {
        return [
            'title' => 'required|min:5|max:128',
            'text' => 'required|min:3',
            'category.*' => 'required|integer|exists:categories,id',
        ];
    }
}
