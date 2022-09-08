<?php

namespace App\Http\Requests;

use App\Dto\NoteDto;

class UpdateNoteRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'id' => 'exists:notes,id',
            'note.id' => 'exists:notes,id',

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
