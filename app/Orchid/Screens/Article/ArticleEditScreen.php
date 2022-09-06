<?php

namespace App\Orchid\Screens\Article;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Orchid\Components\ExtendedQuill;
use App\Repositories\ArticleRepository;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class ArticleEditScreen extends Screen
{
    public Article $article;

    private ArticleRepository $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Query data.
     *
     * @param Article $article
     * @return array
     */
    public function query(Article $article): iterable
    {
        return [
            'article' => $article,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->article->exists ? __('Article.Orchid.Update') : __('Article.Orchid.Create');
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Article.Button.Create'))
                ->icon('note')
                ->method('create')
                ->canSee(!$this->article->exists),

            Button::make(__('Article.Button.Update'))
                ->icon('note')
                ->method('update')
                ->canSee($this->article->exists),

            Button::make(__('Article.Button.Delete'))
                ->icon('trash')
                ->method('remove')
                ->canSee($this->article->exists),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([

                Input::make('article.id')->type('hidden'),

                Input::make('article.title')
                    ->title(__('Article.Label.Title'))
                    ->placeholder(__('Article.Placeholder.Title')),

                TextArea::make('article.preview')
                    ->title(__('Article.Label.Preview'))
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder(__('Article.Placeholder.Preview')),

                Input::make('article.link')
                    ->title(__('Article.Label.Link'))
                    ->placeholder(__('Article.Placeholder.Link')),

                CheckBox::make('article.active')
                    ->title(__('Article.Label.Active'))
                    ->sendTrueOrFalse(),

                Relation::make('article.created_by')
                    ->title(__('Article.Label.Author'))
                    ->fromModel(User::class, 'name'),

                Relation::make('article.category')
                    ->title(__('Article.Label.Category'))
                    ->fromModel(Category::class, 'name')
                    ->multiple(),

                Quill::make('article.text')->title(__('Article.Label.Text')),

                input::make('article.disk')->title(__('Article.Label.Disk')),
            ]),
        ];
    }

    public function create(CreateArticleRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $this->repository->create($dto);

        Alert::info(__('Article.Message.Created'));

        return redirect()->route('platform.articles');
    }

    public function update(UpdateArticleRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $this->repository->update($dto);

        Alert::info(__('Article.Message.Updated'));

        return redirect()->route('platform.articles');
    }

    public function remove(Article $article): RedirectResponse
    {
        $this->repository->remove($article->id);

        Alert::info(__('Article.Message.Deleted'));

        return redirect()->route('platform.articles');
    }
}
