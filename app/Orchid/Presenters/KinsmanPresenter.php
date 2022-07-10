<?php

namespace App\Orchid\Presenters;

use App\Models\Kinsman;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Scout\Builder;
use Orchid\Screen\Contracts\Personable;
use Orchid\Screen\Contracts\Searchable;
use Orchid\Support\Presenter;

class KinsmanPresenter extends Presenter implements Searchable, Personable
{
    /** @var Kinsman $entity */
    public $entity;

    public function perSearchShow(): int
    {
        return 3;
    }

    public function searchQuery(string $query = null): Builder
    {
        return $this->entity->search($query);
    }

    public function label(): string
    {
        return 'Kinsman';
    }

    public function title(): string
    {
        $name = $this->entity->name;
        $name .= ' ' . $this->entity->middle_name;

        return $name;
    }

    public function subTitle(): string
    {
        return $this->entity->kin->name ?? '';
    }

    public function url(): string
    {
        return route('platform.kinsman.edit', $this->entity->id);
    }

    public function image(): ?string
    {
        $image = $this->entity->attachment()->first() ?? null;

        if (!$image) {
            $name = $this->entity->gender === 'male' ? 'man' : 'woman';

//            return "/storage/img/{$name}.jpg";
            return storage_path("img/{$name}.jpg");
        }

        return $image->url();
    }

    public function imageInfo(): ?array
    {
        $image = $this->entity->attachment()->first() ?? null;

        if ($image) {
            return json_decode($image, true);
        }

        return $image;
    }

    public function gender(): string
    {
        $genders = [
            'male' => __('Kinsman.Select.Male'),
            'female' => __('Kinsman.Select.Female'),
        ];

        return $genders[$this->entity->gender];
    }

    public function color(bool $admin = false): string
    {
        $color = $this->entity->kin->color ?? 'grey';

        if ($admin) {
            return "style=\"border: 3px solid {$color};\"";
        }

        return "style=\"background-color: {$color};\"";
    }

    public function birthDate(bool $raw = false): ?string
    {
        if (isset($this->entity->life) && !empty($this->entity->life->birth_date)) {
            if ($raw) {
                return $this->entity->life->birth_date;
            }

            return Carbon::make($this->entity->life->birth_date)->format('j F Y');
        }

        return null;
    }

    public function deathDate(bool $raw = false): ?string
    {
        if (isset($this->entity->life) && !empty($this->entity->life->end_date)) {
            if ($raw) {
                return $this->entity->life->end_date;
            }

            return Carbon::make($this->entity->life->end_date)->format('j F Y');
        }

        return null;
    }

    public function wed(): ?Kinsman
    {
        if ($this->entity->gender === 'male') {
            $wed = $this->entity->wife->first();
        }

        if ($this->entity->gender === 'female') {
            $wed = $this->entity->husband->first();
        }

        return $wed ?? null;
    }

    public function exWed(): Collection
    {
        if ($this->entity->gender === 'male') {
            $exWed = $this->entity->exWife;
        }

        if ($this->entity->gender === 'female') {
            $exWed = $this->entity->exHusband;
        }

        return $exWed ?? Collection::make();
    }

    public function wedKey(bool $title = false): ?string
    {
        if ($this->entity->gender === 'male') {
            return $title ? 'Wife' : 'wife';
        }

        if ($this->entity->gender === 'female') {
            return $title ? 'Husband' : 'husband';
        }

        return null;
    }
}
