<?php

namespace App\Repositories;

use App\Dto\LifeDto;
use App\Helpers\NameHelper;
use App\Interfaces\DtoInterface;
use App\Interfaces\RepositoryInterface;
use App\Models\Kinsman;
use App\Models\Life;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class LifeRepository extends BaseRepository implements RepositoryInterface
{
    private Life $lifeModel;
    private Kinsman $kinsmanModel;

    public function __construct(Life $lifeModel, Kinsman $kinsman)
    {
        $this->lifeModel = $lifeModel;
        $this->kinsmanModel = $kinsman;
    }

    public function getAll(array $options = []): LengthAwarePaginator
    {
        $life = $this->lifeModel->where(['active' => true]);

        if (Arr::has($options, 'eager')) {
            $life = $life->with(['kinsman']);
        }

        if (Arr::has($options, 'search')) {
            $life = $life->search(Arr::get($options, 'search'));
        }

        if (Arr::has($options, 'defaultSort')) {
            $life = $life->filters()
                ->defaultSort(Arr::get($options, 'defaultSort'));
        }

        return $life->paginate(Arr::get($options, 'perPage'));
    }

    public function getOne(int $id, bool $active = true): ?Model
    {
        return $this->lifeModel
            ->with('kinsman')
            ->where(['id' => $id])
            ->where(['active' => $active])
            ->first();
    }

    public function getOneByKinsmanId(int $kinsmanId, bool $active = true): ?Model
    {
        return $this->lifeModel
            ->with('kinsman')
            ->where(['kinsman_id' => $kinsmanId])
            ->where(['active' => $active])
            ->first();
    }

    public function add(): array
    {
        $kinsmans = $this->kinsmanModel
            ->where(['active' => true])
            ->get()
            ->keyBy('id');

        return [$this->lifeModel, $kinsmans];
    }

    public function create(DtoInterface $dto): ?int
    {
        /** @var Life $life */
        $life = $this->setFields($this->lifeModel, $dto);

        $saved = $life->save();

        return $saved ? $life->id : null;
    }

    public function edit(int $id): array
    {
        $life = $this->kinsmanModel
            ->where(['id' => $id])
            ->first();

        $kinsmans = $this->kinsmanModel
            ->where(['active' => true])
            ->get()
            ->keyBy('id');

        return [$life, $kinsmans];
    }

    public function update(DtoInterface $dto): ?int
    {
        /** @var LifeDto $dto */
        $life = $this->lifeModel->findOrFail($dto->id);

        $life = $this->setFields($life, $dto);

        $updated = $life->update();

        return $updated ? $life->id : null;
    }

    public function remove(int $id): string
    {
        $life = $this->lifeModel->find($id);
        $life->delete();

        return NameHelper::getActionName();
    }

    public function restore(int $id): string
    {
        $life = $this->lifeModel->withTrashed()->find($id);
        $life->restore();

        return NameHelper::getActionName();
    }

    private function setFields(Life $kin, DtoInterface $dto): ?Model
    {
        foreach ($dto as $prop => $value) {
            if ($dto->$prop !== null) {
                $kin->$prop = $value;
            }
        }

        return $kin;
    }
}
