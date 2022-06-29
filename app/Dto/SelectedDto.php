<?php

namespace App\Dto;

use Illuminate\Contracts\Support\Arrayable;

class SelectedDto
{
    public ?int $fatherId;
    public ?int $motherId;
    public ?int $kinId;
    public ?int $noteId;
    public Arrayable $categories;
}
