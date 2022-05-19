<?php

namespace App\Http\Controllers;

use App\Helpers\NameHelper;
use App\Http\Requests\ArticleRequestStore;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class ArticleController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $articles = $this->getArticleList();

        return view('articles.index', [
            'models' => $articles,
            'nav' => $this->nav,
        ]);
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $article = new Article();
        $categories = Category::getAll();

        return view('articles.edit', [
            'model' => $article,
            'categories' => $categories,
            'selected' => [],
            'nav' => $this->nav,
        ]);
    }

    public function store(ArticleRequestStore $request): RedirectResponse
    {
        $data = $request->all();

        $article = Article::findOrNew($request->id);
        $article->fill($data);

        $article->preview = $request->title;

        $article->created_by = User::first()->id;
        $article->disk = '';

        $article->save();

        $article->category()->attach(Arr::get($data, 'category'));

        return redirect()->route('articles.show', $article->id);
    }

    public function show(int $id): string
    {
        $article = Article::with(['category'])->where(['id' => $id])->first();

        return view('articles.show', [
            'title' => $article->title,
            'model' => $article,
            'selected' => $article->category->toArray(),
            'nav' => $this->nav,
        ]);
    }

    public function edit(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $article = Article::with('category')
            ->where(['id' => $id])
            ->first();

        $categories = Category::getAll();

        $selected = $article->category->keyBy('id');

        return view('articles.edit', [
            'title' => $article->title,
            'model' => $article,
            'categories' => $categories,
            'selected' => $selected->toArray(),
            'nav' => $this->nav,
        ]);
    }

    public function destroy(int $id): string
    {
        $article = Article::find($id);
        $article->delete();

        return NameHelper::getActionName();
    }

    public function search(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $string = $request->get('search') ?? $request->query->get('query') ?? '';
        $articles = $this->getArticleList($string);

        return view('articles.index', [
            'models' => $articles,
            'nav' => $this->nav,
            'string' => $string,
        ]);
    }

    private function getArticleList(string $search = ''): LengthAwarePaginator
    {
        $model = new Article();
        $perPage = 8;

        if ($search) {
            $model = $model->search($search);
        }

        return $model->paginate($perPage);
    }
}
