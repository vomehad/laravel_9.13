<?php

namespace App\Orchid\Screens\Category;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Note;
use App\Repositories\CategoryRepository;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class CategoryEditScreen extends Screen
{
    public Category $category;

    private CategoryRepository $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Category $category): iterable
    {
        return [
            'category' => $category,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->category->exists ? 'Edit category' : 'Creating a new category';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Category.Button.Create'))
                ->icon('pencil')
                ->method('create')
                ->canSee(!$this->category->exists),

            Button::make(__('Category.Button.Update'))
                ->icon('note')
                ->method('update')
                ->canSee($this->category->exists),

            Button::make(__('Category.Button.Delete'))
                ->icon('trash')
                ->method('remove')
                ->canSee($this->category->exists),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([

                Input::make('category.id')->type('hidden'),

                Input::make('category.name')->title(__('Category.Label.Name'))->placeholder(__('Category.Label.Name')),

                CheckBox::make('category.active')->title(__('Category.Label.Active'))->sendTrueOrFalse(),

//                Relation::make('category.article')
//                    ->title(__('Category.Label.Article'))
//                    ->fromModel(Article::class, 'title')
//                    ->multiple(),
//
//                Relation::make('category.note')
//                    ->title(__('Category.Label.Note'))
//                    ->fromModel(Note::class, 'name')
//                    ->multiple(),
            ])
        ];
    }

    public function create(CreateCategoryRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $this->repository->create($dto);

        Toast::info(__('Category.Message.Created'));

        return redirect()->route('platform.categories');
    }

    public function update(UpdateCategoryRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $this->repository->update($dto);

        Toast::info(__('Category.Message.Updated'));

        return redirect()->route('platform.categories');
    }

    public function remove(Category $category): RedirectResponse
    {
        $this->repository->remove($category->id);

        Toast::info(__('Category.Message.Deleted'));

        return redirect()->route('platform.categories');
    }
}
