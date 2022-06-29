<?php

namespace App\Orchid\Screens\Note;

use App\Http\Requests\CreateNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Category;
use App\Models\Note;
use App\Repositories\NoteRepository;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class NoteEditScreen extends Screen
{
    public Note $note;

    private NoteRepository $repository;

    public function __construct(NoteRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Note $note): iterable
    {
        return [
            'note' => $note,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->note->exists ? 'Edit note' : 'Creating a new note';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [

            Button::make(__('Note.Button.Create'))
                ->icon('note')
                ->method('create')
                ->canSee(!$this->note->exists),

            Button::make(__('Note.Button.Update'))
                ->icon('note')
                ->method('update')
                ->canSee($this->note->exists),

            Button::make(__('Note.Button.Delete'))
                ->icon('trash')
                ->method('remove')
                ->canSee($this->note->exists),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([

                Input::make('note.id')->type('hidden'),

                Input::make('note.name')
                    ->title(__('Note.Label.Name'))
                    ->placeholder(__('Note.Placeholder.Name')),

                TextArea::make('note.content')
                    ->title(__('Note.Label.Content'))
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder(__('Note.Placeholder.Content')),

                CheckBox::make('note.active')
                    ->title(__('Note.Label.Active'))
                    ->sendTrueOrFalse(),

                Relation::make('note.category')
                    ->title(__('Note.Label.Category'))
                    ->fromModel(Category::class, 'name')
                    ->multiple(),

            ]),
        ];
    }

    public function create(CreateNoteRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $this->repository->create($dto);

        Alert::info(__('Note.Message.Created'));

        return redirect()->route('platform.notes');
    }

    public function update(UpdateNoteRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $this->repository->update($dto);

        Alert::info(__('Note.Message.Updated'));

        return redirect()->route('platform.notes');
    }

    public function remove(Note $note): RedirectResponse
    {
        $this->repository->remove($note->id);

        Alert::info(__('Note.Message.Deleted'));

        return redirect()->route('platform.notes');
    }
}
