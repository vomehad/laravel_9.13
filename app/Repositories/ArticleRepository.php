<?php

namespace App\Repositories;

use App\Dto\SelectedDto;
use App\Helpers\NameHelper;
use App\Interfaces\DtoInterface;
use App\Interfaces\RepositoryInterface;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ArticleRepository extends BaseRepository implements RepositoryInterface
{
    private Article $articleModel;
    private Category $categoryModel;

    public function __construct(Article $articleModel, Category $categoryModel)
    {
        $this->articleModel = $articleModel;
        $this->categoryModel = $categoryModel;
    }

    public function getAll(array $options = []): LengthAwarePaginator
    {
        $articles = $this->articleModel;

        if (Arr::has($options, 'eager')) {
            $articles = $articles->with(['category', 'author']);
        }

        if (Arr::has($options, 'search')) {
            $articles = $articles->search(Arr::get($options, 'search'));
        }

        if (Arr::has($options, 'defaultSort')) {
            $articles = $articles->filters()->defaultSort(Arr::get($options, 'defaultSort'));
        }

        return $articles->paginate(Arr::get($options, 'perPage'));
    }

    public function getOne(int $id): ?Model
    {
        return $this->articleModel
            ->with('category')
            ->where(['id' => $id])
            ->where(['active' => true])
            ->first();
    }

    public function add(): array
    {
        $categories = $this->categoryModel
            ->where(['active' => true])
            ->get();

        return [$this->articleModel, $categories];
    }

    public function create(DtoInterface $dto): ?int
    {
        $article = $this->setFields($this->articleModel, $dto);
        $article->preview = $this->getPreview($dto);
        $article->disk = $this->setDisk();

        $saved = $article->save();

        $article->category()->sync($dto->category);

        return $saved ? $article->id : null;
    }

    private function setFields(Article $article, DtoInterface $dto): Article
    {
        foreach ($dto as $prop => $value) {
            if ($dto->$prop !== null) {
                if (is_array($dto->$prop)) {
                    continue;
                }

                $article->$prop = $value;
            }
        }

        return $article;
    }

    private function getPreview(DtoInterface $dto, int $long = 255): string
    {
        $pattern = '/\.([^.]*)$/';
        $previewText = mb_substr(strip_tags($dto->text), 0, $long);

        return preg_replace($pattern, '.', $previewText);
    }

    private function setDisk(): string
    {
        return '';
    }

    public function edit(int $id): array
    {
        $article = $this->articleModel
            ->where(['id' => $id])
            ->where(['active' => true])
            ->first();
        $categories = $this->categoryModel
            ->where(['active' => true])
            ->get()
            ->keyBy('id');

        $selected = new SelectedDto();
        $selected->categories = $article->category
                ->keyBy('id')
                ->map(function ($item) {
                    return $item->id;
                }) ?? null;

        return [$article, $categories, $selected];
    }

    public function update(DtoInterface $dto): ?int
    {
        $article = $this->articleModel->findOrNew($dto->id);

        $article = $this->setFields($article, $dto);

        return $article->update() ? $article->id : null;
    }

    public function remove(int $id): string
    {
        /** @var Article $article */
        $article = $this->articleModel->find($id);
        $article->delete();

        return NameHelper::getActionName();
    }

    public function restore(int $id): string
    {
        $article = $this->articleModel->withTrashed()->find($id);
//        $article = $this->articleModel->onlyTrashed()->find($id);
        $article->restore();

        return NameHelper::getActionName();
    }
}
