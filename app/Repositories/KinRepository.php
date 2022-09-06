<?php

namespace App\Repositories;

use App\Dto\SelectedDto;
use App\Helpers\NameHelper;
use App\Interfaces\DtoInterface;
use App\Interfaces\RepositoryInterface;
use App\Models\Kin;
use App\Models\Kinsman;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class KinRepository extends BaseRepository implements RepositoryInterface
{
    private Kin $kinModel;
    private Kinsman $kinsmanModel;

    public function __construct(Kin $kinModel, Kinsman $kinsmanModel)
    {
        $this->kinModel = $kinModel;
        $this->kinsmanModel = $kinsmanModel;
    }

    public function getAll(array $options = []): LengthAwarePaginator
    {
        $kins = $this->kinModel->where(['active' => true]);

        if (Arr::has($options, 'search')) {
            $kins = $kins->search(Arr::get($options, 'search'));
        }

        if (Arr::has($options, 'defaultSort')) {
            $kins = $kins->filters()->defaultSort(Arr::get($options, 'defaultSort'));
        }

        return $kins->paginate(Arr::get($options, 'perPage'));
    }

    public function getOne(int $id): ?Model
    {
        return $this->kinModel
            ->with(['kinsman'])
            ->where(['id' => $id])
            ->where(['active' => true])
            ->first();
    }

    public function add(): array
    {
        return [$this->kinModel];
    }

    public function create(DtoInterface $dto): ?int
    {
        $kin = $this->setFields($this->kinModel, $dto);
        $kin->slug = Str::slug($kin->name);
        $kin->generation = 1;
        $kin->created_by = auth()->id();

        $saved = $kin->save();

//        $kin->kinsman()->sync($dto->kinsman);

        return $saved ? $kin->id : null;
    }

    private function setFields(Kin $kin, DtoInterface $dto): Kin
    {
        foreach ($dto as $prop => $value) {
            if ($dto->$prop !== null) {
                if (is_array($dto->$prop)) {
                    continue;
                }

                $kin->$prop = $value;
            }
        }

        return $kin;
    }

    public function edit(int $id): array
    {
        $kin = $this->kinModel
            ->with(['kinsman'])
            ->where(['id' => $id])
            ->where(['active' => true])
            ->first();
        $kinsmans = $this->kinsmanModel
            ->where(['active' => true])
            ->get()
            ->keyBy('id');

        $selected = new SelectedDto();
        $selected->categories = $kin->kinsman
                ->keyBy('id')
                ->map(function ($item) {
                    return $item->id;
                }) ?? null;

        return [$kin, $kinsmans, $selected];
    }

    public function update(DtoInterface $dto): ?int
    {
        $kin = $this->kinModel->findOrFail($dto->id);

        $kin = $this->setFields($kin, $dto);

        $updated = $kin->update();

//        $kin->kinsman()->sync($dto->kinsman);

        return $updated ? $kin->id : null;
    }

    public function remove(int $id): string
    {
        /** @var Kin $kin */
        $kin = $this->kinModel->find($id);
        $kin->delete();

        return NameHelper::getActionName();
    }

    public function restore(int $id): string
    {
        $kin = $this->kinModel->onlyTrashed()->find($id);
        $kin->restore();

        return NameHelper::getActionName();
    }
}
