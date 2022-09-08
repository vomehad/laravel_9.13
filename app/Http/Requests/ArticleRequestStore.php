<?php

namespace App\Http\Requests;

use JetBrains\PhpStorm\ArrayShape;

/**
 * Class ArticleRequestStore
 *
 * @package App\Http\Requests
 *
 * @property int $id
 * @property string $title
 */
class ArticleRequestStore extends BaseRequest
{
    #[ArrayShape([
        'title' => "string",
        'text' => "string",
        'category.*' => "string"
    ])]
    public function rules(): array
    {
        return [
            'title' => 'required|min:5|max:128',
            'text' => 'required|min:3',
            'category.*' => 'required|integer|exists:categories,id',
        ];
    }
}
