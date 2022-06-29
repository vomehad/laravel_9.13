<?php

namespace App\Repositories;

use App\Dto\SelectedDto;
use App\Helpers\NameHelper;
use App\Interfaces\DtoInterface;
use App\Interfaces\RepositoryInterface;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class CategoryRepository extends BaseRepository implements RepositoryInterface
{
    private Category $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function getAll(array $options = []): LengthAwarePaginator
    {
        $categories = $this->model->where(['active' => true]);

        if (Arr::has($options, 'search')) {
            $categories = $categories->search(Arr::get($options, 'search'));
        }

        if (Arr::has($options, 'defaultSort')) {
            $categories = $categories->filters()->defaultSort(Arr::get($options, 'defaultSort'));
        }

        return $categories->paginate(Arr::get($options, 'perPage'));
    }

    public function getOne(int $id): ?Model
    {
        return $this->model
            ->with(['article', 'note'])
            ->where(['id' => $id])
            ->where(['active' => true])
            ->first();
    }

    public function add(): array
    {
        $categories = $this->model
            ->where(['active' => true])
            ->get();

        return [$this->model, $categories];
    }

    public function create(DtoInterface $dto): ?int
    {
        $category = $this->setFields($this->model, $dto);

        $saved = $category->save();

        return $saved ? $category->id : null;
    }

    public function edit(int $id): array
    {
        $category = $this->model
            ->where(['id' => $id])
            ->where(['active' => true])
            ->first();
//        $articles = $this->categoryModel
//            ->where(['active' => true])
//            ->get()
//            ->keyBy('id');

        $selected = new SelectedDto();
//        $selected->categories = $article->category
//                ->keyBy('id')
//                ->map(function ($item) {
//                    return $item->id;
//                }) ?? null;

        return [$category, $selected];
    }

    public function update(DtoInterface $dto): ?int
    {
        $category = $this->model->findOrNew($dto->id);

        $category = $this->setFields($category, $dto);

        return $category->update() ? $category->id : null;
    }

    public function remove(int $id): string
    {
        /** @var Category $category */
        $category = $this->model->find($id);
        $category->delete();

        return NameHelper::getActionName();
    }

    public function restore(int $id): string
    {
        $category = $this->model->withTrashed()->find($id);
//        $category = $this->articleModel->onlyTrashed()->find($id);
        $category->restore();

        return NameHelper::getActionName();
    }

    private function setFields(Category $category, DtoInterface $dto): Category
    {
        foreach ($dto as $prop => $value) {
            if ($dto->$prop !== null) {
                if (is_array($dto->$prop)) {
                    continue;
                }

                $category->$prop = $value;
            }
        }

        return $category;
    }
}
