<?php

namespace App\Orchid\Filters\Kin;

use App\Models\Kin;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;

class KinFilter extends Filter
{
    /**
     * The displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return __('Kin.Label.Filter');
    }

    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function parameters(): ?array
    {
        return ['kin'];
    }

    /**
     * Apply to a given Eloquent query builder.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('kin', function (Builder $query) {
            $query->where('slug', $this->request->get('kin'));
        });
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     * @throws
     */
    public function display(): iterable
    {
        return [
            Select::make('kin')
                ->fromModel(Kin::class, 'name', 'slug')
                ->empty()
                ->value($this->request->get('kin'))
                ->title(__('Kin.Label.Filter'))
        ];
    }

    /**
     * @return string
     * @throws
     */
    public function value(): string
    {
        return $this->name() . ': ' . Kin::where('slug', $this->request->get('kin'))->first()->name;
    }
}
