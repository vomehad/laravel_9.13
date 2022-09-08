<?php

namespace App\Http\Requests;

use App\Dto\CategoryDto;
use App\Interfaces\TransportInterface;

class UpdateCategoryRequest extends BaseRequest implements TransportInterface
{
    public function rules(): array
    {
        return [
            'id' => 'required_if:category.id,null|int',
            'category.id' => 'required_if:id,null|int',

            'name' => 'required_if:category.name,null|min:5|max:128',
            'category.name' => 'required_if:name,null|min:5|max:128',

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
