<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class ArticleController extends Controller
{
    private const PER_PAGE = 10;
    private const DEFAULT_SORT = 'updated_at';
    private const EAGER_LOADING = true;
    private const OPTIONS = [
        'perPage' => self::PER_PAGE,
        'defaultSort' => self::DEFAULT_SORT,
        'eager' => self::EAGER_LOADING,
    ];

    private ArticleRepository $repository;

    public function __construct(ArticleRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function index()
    {
        $articles = $this->repository->getAll(self::OPTIONS);

        return view('articles.index', [
            'models' => $articles,
            'nav' => $this->nav,
        ]);
    }

    public function create()
    {
        [$article, $categories] = $this->repository->add();

        return view('articles.create', [
            'model' => $article,
            'categories' => $categories,
            'nav' => $this->nav,
        ]);
    }

    public function store(CreateArticleRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $articleId = $this->repository->create($dto);

        if ($articleId) {
            return redirect()
                ->route('articles.show', $articleId)
                ->with(['success' => Lang::get('Article.Message.Saved')]);
        } else {
            return back()
                ->withErrors(['msg' => Lang::get('Article.Message.Error')])
                ->withInput();
        }
    }

    public function show(int $id): string
    {
        /** @var Article $article */
        $article = $this->repository->getOne($id);

        return view('articles.show', [
            'title' => $article->title,
            'model' => $article,
            'nav' => $this->nav,
        ]);
    }

    public function edit(int $id)
    {
        /** @var Article $article */
        [$article, $categories, $selected] = $this->repository->edit($id);

        return view('articles.edit', [
            'title' => $article->title,
            'model' => $article,
            'categories' => $categories,
            'selected' => $selected,
            'nav' => $this->nav,
        ]);
    }

    public function update(UpdateArticleRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $articleId = $this->repository->update($dto);

        if ($articleId) {
            return redirect()
                ->route('articles.show', $articleId)
                ->with(['success' => Lang::get('Article.Message.Saved')]);
        } else {
            return back()
                ->withErrors(['msg' => Lang::get('Article.Message.Error')])
                ->withInput();
        }
    }

    public function destroy(int $id): string
    {
        return $this->repository->remove($id);
    }

    public function search(Request $request)
    {
        $options = [
            'search' => $request->get('search') ?? $request->query->get('query') ?? '',
        ];

        $articles = $this->repository->getAll($options);

        return view('articles.index', [
            'models' => $articles,
            'string' => $options['search'],
            'nav' => $this->nav,
        ]);
    }
}
