<?php

namespace App\Orchid\Layouts\Note;

use App\Models\Note;
use Carbon\Carbon;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class NoteLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'notes';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', __('Note.Label.Name'))
                ->cantHide()
                ->render(function(Note $note) {
                    return Link::make($note->name)->route('platform.note.edit', $note->id);
                })->sort(),

            TD::make('content', __('Note.Label.Content'))
                ->defaultHidden()
                ->width('360px')
                ->render(function (Note $note) {
                    return $note->presenter()->excerpt(30);
                }),

            TD::make('active', __('Note.Label.Active'))
                ->defaultHidden()
                ->render(function(Note $note) {
                    return Switcher::make()
                        ->sendTrueOrFalse()
                        ->value($note->active)
                        ->disabled(true);
                }
            ),

            TD::make('parent_id', __('Note.Label.Parent'))
                ->render(function(Note $note) {
                    $parentId = $note->parentNote->id ?? null;

                    if ($parentId) {
                        return Link::make($note->parentNote->name)
                            ->route('platform.note.edit', ['note' => $note->parentNote->id]);
                    }

                    return null;
                }),

            TD::make('updated_at', __('Note.Label.Updated'))
                ->render(function(Note $note) {
                    return Carbon::make($note->updated_at)->format('j-M-Y H:i');
                })
                ->sort(),
            TD::make('created_at', __('Note.Label.Created'))
                ->defaultHidden()
                ->sort(),

            TD::make(__('Note.Button.Action'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function(Note $note) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                                Link::make(__('Note.Button.Update'))
                                    ->icon('pencil')
                                    ->route('platform.note.edit', $note->id),
                            ],
                    );
                }
            ),
        ];
    }
}
