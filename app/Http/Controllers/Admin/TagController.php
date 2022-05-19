<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\NameHelper;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $tags = Tag::all();

        return view('tags.index', [
            'models' => $tags,
            'nav' => $this->nav
        ]);
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $tag = new Tag();

        return view('tags.edit', [
            'model' => $tag,
            'nav' => $this->nav,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $tag = $request->id ? Tag::find($request->id) : new Tag();
        $tag->name = $request->get('name');
        $tag->description = $request->get('description');

        $tag->save();

        return redirect()->route('tags.show', $tag->id);
    }

    public function show(int $id): string
    {
        $tag = Tag::find($id);

        return view('tags.show', [
            'title' => $tag->name,
            'model' => $tag,
            'nav' => $this->nav,
        ]);
    }

    public function update(int $id): string
    {
        $tag = Tag::find($id);

        return view('tags.edit', [
            'title' => $tag->name,
            'model' => $tag,
            'nav' => $this->nav,
        ]);
    }

    public function destroy(int $id): string
    {
        $tag = Tag::find($id);
        $tag->delete();

        return NameHelper::getActionName();
    }
}
