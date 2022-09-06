<?php

namespace App\Repositories;

use App\Dto\CityDto;
use App\Helpers\NameHelper;
use App\Interfaces\DtoInterface;
use App\Interfaces\RepositoryInterface;
use App\Models\City;
use App\Models\Life;
use App\Orchid\Layouts\Kinsman\KinsmanFilterLayout;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class CityRepository extends BaseRepository implements RepositoryInterface
{
    private City $cityModel;
    private Life $lifeModel;

    public function __construct(City $cityModel, Life $lifeModel)
    {
        $this->cityModel = $cityModel;
        $this->lifeModel = $lifeModel;
    }

    public function getAll(array $options = []): LengthAwarePaginator
    {
        $cities = $this->cityModel->where(['active' => true]);

        if (Arr::has($options, 'defaultSort')) {
            $cities = $cities->filters()
                ->filtersApplySelection(KinsmanFilterLayout::class)
                ->defaultSort(Arr::get($options, 'defaultSort'));
        }

        return $cities->paginate(Arr::get($options, 'perPage'));
    }

    public function getOne(int $id): ?Model
    {
        return $this->cityModel
            ->where(['id' => $id])
            ->where(['active' => true])
            ->first();
    }

    public function getOneByGeo(string $geo): ?City
    {
        return $this->cityModel
            ->where(['geo' => $geo])
            ->where(['active' => true])
            ->first();
    }

    public function add(): array
    {
        $lifeList = $this->lifeModel
            ->where(['active' => true])
            ->get()
            ->keyBy('id');

        return [$this->cityModel, $lifeList];
    }

    public function create(DtoInterface $dto): ?int
    {
        $city = $this->setFields($this->cityModel, $dto);

        $saved = $city->save();

        return $saved ? $city->id : null;
    }

    private function setFields(City $city, DtoInterface $dto): City
    {
        foreach ($dto as $prop => $value) {
            if ($dto->$prop !== null) {
                $city->$prop = $value;
            }
        }

        return $city;
    }

    public function edit(int $id): array
    {
        $city = $this->cityModel
            ->where(['id' => $id])
            ->where(['active' => true])
            ->first();

        $lifeList = $this->lifeModel
            ->where(['active' => true])
            ->get()
            ->keyBy('id');

        return [$city, $lifeList];
    }

    public function update(DtoInterface $dto): ?int
    {
        /** @var CityDto $dto */
        $city = $this->cityModel->findOrNew($dto->id);

        $city = $this->setFields($city, $dto);

        $updated = $city->update();

        return $updated ? $city->id : null;
    }

    public function remove(int $id): string
    {
        /** @var City $city */
        $city = $this->cityModel->find($id);
        $city->delete();

        return NameHelper::getActionName();
    }

    public function restore(int $id): string
    {
        $city = $this->cityModel->withTrashed()->find($id);
        $city->restore();

        return NameHelper::getActionName();
    }
}
