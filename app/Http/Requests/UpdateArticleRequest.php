<?php

namespace App\Http\Requests;

use App\Dto\ArticleDto;
use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
            'id' => 'int',
            'article.id' => 'int',

            'title' => 'required_if:title,title|min:5|max:128',
            'article.title' => 'required_if:article.title,article.title|min:5|max:128',

            'active' => 'bool',
            'article.active' => 'bool',

            'preview' => 'nullable|max:200',
            'article.preview' => 'nullable|max:200',

            'link' => 'nullable|string:regex:/^http(s)?:\/\/(.*)/',
            'article.link' => 'nullable|string:regex:/^http(s)?:\/\/(.*)/',

            'created_by' => 'required_if:created_by,created_by|integer|exists:users,id',
            'article.created_by' => 'required_if:article.created_by,created_by|integer|exists:users,id',

            'category.*' => 'required_if:category.*,category.*|integer|exists:categories,id',
            'article.category.*' => 'required_if:article.category.*,article.category.*|integer|exists:categories,id',

            'text' => 'required_if:text,text|min:3',
            'article.text' => 'required_if:article.text,article.text|min:3',

            'disk' => 'nullable|string',
            'article.disk' => 'nullable|string',
        ];
    }

    public function createDto(): ArticleDto
    {
        return app(ArticleDto::class)->createFromRequest($this->validated());
    }
}
