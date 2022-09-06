<?php

namespace App\Orchid\Presenters;

use App\Models\Note;
use Orchid\Support\Presenter;

class NotePresenter extends Presenter
{
    /** @var Note $entity */
    public $entity;

    public function title(): string
    {
        return $this->entity->name;
    }

    public function url(): string
    {
        return route('platform.kinsman.edit', $this->entity->id);
    }

    public function excerpt(int $chars = 40)
    {
        return preg_replace("/^(.{$chars})(.*)/", '$1...', $this->entity->content);
    }
}
