<?php

namespace App\Orchid\Screens\Article;

use App\Orchid\Layouts\Article\ArticleListLayout;
use App\Repositories\ArticleRepository;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class ArticleListScreen extends Screen
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
        $this->repository = $repository;
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'articles' => $this->repository->getAll(self::OPTIONS),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Article.Orchid.Title');
    }

    public function description(): ?string
    {
        return "All blog posts";
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Article.Button.Create'))
                ->icon('pencil')
                ->route('platform.article.create'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ArticleListLayout::class
        ];
    }
}
