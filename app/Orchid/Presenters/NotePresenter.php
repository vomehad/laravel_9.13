<?php

namespace App\Orchid\Presenters;

use App\Models\Kinsman;
use App\Models\Note;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Scout\Builder;
use Orchid\Screen\Contracts\Personable;
use Orchid\Screen\Contracts\Searchable;
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
