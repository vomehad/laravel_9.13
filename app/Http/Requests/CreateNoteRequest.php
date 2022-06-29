<?php

namespace App\Http\Requests;

use App\Dto\NoteDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateNoteRequest extends FormRequest
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
            'name' => 'required_if:note.name,null|string|max:255',
            'note.name' => 'required_if:name,null|string|max:255',

            'category.*' => 'required_if:note.category.*,null|integer|exists:categories,id',
            'note.category.*' => 'required_if:category.*,null|integer|exists:categories,id',

            'parent_id' => 'nullable|integer|exists:notes,id',
            'note.parent_id' => 'nullable|integer|exists:notes,id',

            'content' => 'required_if:note.content,null|string|min:14',
            'note.content' => 'required_if:content,null|string|min:14',
        ];
    }

    public function createDto(): NoteDto
    {
        return app(NoteDto::class)->createFromRequest($this->validated());
    }
}
