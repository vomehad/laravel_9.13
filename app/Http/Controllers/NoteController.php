<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use App\Http\Requests\CreateNoteRequest;
use App\Repositories\NoteRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class NoteController extends Controller
{
    private const PER_PAGE = 10;
    private const DEFAULT_SORT = 'updated_at';
    private const EAGER_LOADING = true;
    private const OPTIONS = [
        'perPage' => self::PER_PAGE,
        'defaultSort' => self::DEFAULT_SORT,
        'eager' => self::EAGER_LOADING,
    ];

    private NoteRepository $repository;

    public function __construct(NoteRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function index(): string
    {
        $notes = $this->repository->getAll(self::OPTIONS);

        return view('notes.index', [
            'models' => $notes,
            'nav' => $this->nav,
        ]);
    }

    public function create(): string
    {
        [$note, $notes, $categories] = $this->repository->add();

        return view('notes.create', [
            'model' => $note,
            'parentNotes' => $notes,
            'categories' => $categories,
            'nav' => $this->nav,
        ]);
    }

    public function store(CreateNoteRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $noteId = $this->repository->create($dto);

        if ($noteId) {
            return redirect()
                ->route('test.notes.show', $noteId)
                ->with(['success' => Lang::get('Note.Message.Saved')]);
        } else {
            return back()
                ->withErrors(['msg' => Lang::get('Note.Message.Error')])
                ->withInput();
        }
    }

    public function show(int $id): string
    {
        /** @var Note $note */
        $note = $this->repository->getOne($id);
        $children = $this->repository->getChildren($id);

        return view('notes.show', [
            'title' => $note->name,
            'model' => $note,
            'children' => $children,
            'nav' => $this->nav,
        ]);
    }

    public function edit(int $id): string
    {
        /** @var Note $note */
        [$note, $categories, $selected] = $this->repository->edit($id);

        return view('notes.edit', [
            'title' => $note->name,
            'model' => $note,
            'categories' => $categories,
            'selected' => $selected,
            'nav' => $this->nav,
        ]);
    }

    public function update(UpdateNoteRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $noteId = $this->repository->update($dto);

        if ($noteId) {
            return redirect()
                ->route('test.notes.show', $noteId)
                ->with(['success' => Lang::get('Note.Message.Saved')]);
        } else {
            return back()
                ->withErrors(['msg' => Lang::get('Note.Message.Error')])
                ->withInput();
        }
    }

    public function destroy(int $id): string
    {
        return $this->repository->remove($id);
    }

    public function search(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $options = [
            'search' => $request->get('search') ?? $request->query->get('query') ?? ''
        ];

        $notes = $this->repository->getAll($options);

        return view('notes.index', [
            'models' => $notes,
            'string' => $options['search'],
            'nav' => $this->nav,
        ]);
    }
}
