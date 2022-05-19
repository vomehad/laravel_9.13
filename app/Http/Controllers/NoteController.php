<?php

namespace App\Http\Controllers;

use App\Helpers\NameHelper;
use App\Models\Note;
use App\Http\Requests\NoteRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Lang;

class NoteController extends Controller
{
    public function index(): string
    {
        $notes = $this->getNotes();

        return view('notes.index', [
            'models' => $notes,
            'nav' => $this->nav,
        ]);
    }

    public function create(): string
    {
        $note = new Note();

        return view('notes.edit', [
            'model' => $note,
            'nav' => $this->nav,
        ]);
    }

    public function store(NoteRequest $request): RedirectResponse
    {
        $note = Note::findOrNew($request->id);

        $data = $request->input();
        $saved = $note->fill($data)->save();

        if ($saved) {
            return redirect()
                ->route('test.notes.show', $note->id)
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
        $note = Note::find($id);

        return view('notes.show', [
            'title' => $note->name,
            'model' => $note,
            'nav' => $this->nav,
        ]);
    }

    public function edit(int $id): string
    {
        $note = Note::find($id);

        return view('notes.edit', [
            'title' => $note->name,
            'model' => $note,
            'nav' => $this->nav,
        ]);
    }

    public function destroy(int $id): string
    {
        /** @var Note $note */
        $note = Note::find($id);
        $note->delete();

        return NameHelper::getActionName();
    }

    public function search(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $string = $request->get('search') ?? $request->query->get('query') ?? '';
        $notes = $this->getNotes($string);

        return view('notes.index', [
            'models' => $notes,
            'nav' => $this->nav,
            'string' => $string,
        ]);
    }

    private function getNotes(string $search = ''): LengthAwarePaginator
    {
        $model = new Note();
        $perPage = 10;

        if ($search) {
            $model = $model->search($search);
        }

        return $model->paginate($perPage);
    }
}
