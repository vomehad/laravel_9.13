<?php

namespace App\Http\Requests;

use App\Dto\CategoryDto;
use App\Interfaces\TransportInterface;
use JetBrains\PhpStorm\ArrayShape;

class CreateCategoryRequest extends BaseRequest implements TransportInterface
{
    #[ArrayShape([
        'name' => "string",
        'category.name' => "string",
        'active' => "string",
        'category.active' => "string",
        'article.*' => "string",
        'category.article.*' => "string",
        'note.*' => "string",
        'category.note.*' => "string"
    ])]
    public function rules(): array
    {
        return [
            'name' => 'required_if:category.name,null|min:3|max:128',
            'category.name' => 'required_if:name,null|min:3|max:128',
            'active' => 'bool',
            'category.active' => 'bool',
            'article.*' => 'required_if:category.article.*,null|integer|exists:articles,id',
            'category.article.*' => 'required_if:article.*,null|integer|exists:articles,id',
            'note.*' => 'required_if:category.note.*,null|integer|exists:notes,id',
            'category.note.*' => 'required_if:note.*,null|integer|exists:notes,id',
        ];
    }

    public function createDto(): CategoryDto
    {
        return app(CategoryDto::class)->createFromRequest($this->validated());
    }
}
