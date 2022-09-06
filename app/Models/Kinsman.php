<?php

namespace App\Models;

use App\Orchid\Presenters\KinsmanPresenter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use JetBrains\PhpStorm\Pure;
use Laravel\Scout\Searchable;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class Kinsman
 *
 * @property int $id
 * @property string $name
 * @property string $middle_name
 * @property string $gender
 * @property Kinsman $father
 * @property Kinsman $mother
 * @property Kin $kin
 * @property bool $active
 * @property Life $life
 * @property Collection|City[] $nativeCity
 * @property Collection|Kinsman[] $wife
 * @property Collection|Kinsman[] $exWife
 * @property Collection|Kinsman[] $husband
 * @property Collection|Kinsman[] $exHusband
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * @package App\Models
 */
class Kinsman extends Model
{
    use HasFactory, Searchable, SoftDeletes, AsSource, Filterable, Attachable;

    protected $table = 'kinsmans';

    protected $fillable = [
        'name',
        'middle_name',
        'gender',
        'father_id',
        'mother_id',
        'kin_id',
        'active',
        'photo',
    ];

    protected $allowedFilters = [
        'name',
        'middle_name',
        'gender',
        'active',
    ];

    protected $allowedSorts = [
        'name',
        'middle_name',
        'gender',
        'active',
        'updated_at',
        'created_at',
    ];

    public function father(): BelongsTo
    {
        return $this->belongsTo(Kinsman::class)->withDefault([
            'gender' => 'male',
        ]);
    }

//====================== relations =====================================
    public function mother(): BelongsTo
    {
        return $this->BelongsTo(Kinsman::class)->withDefault([
            'gender' => 'female',
        ]);
    }

    public function kin(): BelongsTo
    {
        return $this->BelongsTo(Kin::class);
    }

    public function life(): HasOne
    {
        return $this->hasOne(Life::class);
    }

    public function nativeCity(): BelongsToMany
    {
        return $this->belongsToMany(
            City::class,
            'life',
            'kinsman_id',
            'native_city_id'
        );
    }

    public function husband(): BelongsToMany
    {
        return $this->belongsToMany(
            Kinsman::class,
            'marriage',
            'wife_id',
            'husband_id'
        )->wherePivot('divorce_date', '=', null);
    }

    public function wife(): BelongsToMany
    {
        return $this->belongsToMany(
            Kinsman::class,
            'marriage',
            'husband_id',
            'wife_id',
            ''
        )->wherePivotNull('divorce_date');
    }

    public function exHusband(): BelongsToMany
    {
        return $this->belongsToMany(
            Kinsman::class,
            'marriage',
            'husband_id',
            'husband_id'
        )->wherePivotNotNull('divorce_date');
    }

    public function exWife(): BelongsToMany
    {
        return $this->belongsToMany(
            Kinsman::class,
            'marriage',
            'husband_id',
            'husband_id'
        )->wherePivotNotNull('divorce_date');
    }

    public function photo(): HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'photo')->withDefault();
    }
// ============================= end relations ===================================

    public function scopeFathers(Builder $query): Builder
    {
        return $query->where(['gender' => 'male'])
            ->where(['active' => true])
            ->where('id', '!=', $this->id);
    }

    public function scopeMothers(Builder $query): Builder
    {
        return $query->where(['gender' => 'female'])
            ->where(['active' => true])
            ->where('id', '!=', $this->id);
    }

    public function scopeKinsman(Builder $query): Builder
    {
        return $query->where(['active' => true]);
    }

    public function scopeWed(Builder $query, string $gender, Collection $children): Builder
    {
        $childrenIds = $children->map(function ($child) {
            return $child->id;
        })->toArray();

        return $query->where(['active' => true])
            ->where(['gender' => $gender === 'male' ? 'female' : 'male'])
            ->whereNotIn('id', $childrenIds)
            ->where('id', '!=', $this->father->id)
            ->where('id', '!=', $gender === 'male' ? $this->father->id : $this->mother->id)
            ->where('id', '!=', $this->id);
    }

    #[Pure]
    public function getFullNameAttribute(): string
    {
        return $this->presenter()->title();
    }

    #[Pure]
    public function presenter(): KinsmanPresenter
    {
        return new KinsmanPresenter($this);
    }

    /**
     * Modify the query used to retrieve models when making all of the models searchable.
     *
     * @param Builder $query
     * @return Builder
     */
    protected function makeAllSearchableUsing(Builder $query): Builder
    {
        return $query->with([
            'father',
            'mother',
            'kin',
            'life',
            'nativeCity',
            'husband',
            'wife',
            'exHusband',
            'exWife',
            'photo',
        ]);
    }
}
