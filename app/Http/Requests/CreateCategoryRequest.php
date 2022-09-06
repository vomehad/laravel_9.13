<?php

namespace App\Http\Requests;

use App\Dto\CategoryDto;
use App\Interfaces\TransportInterface;
use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest implements TransportInterface
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
