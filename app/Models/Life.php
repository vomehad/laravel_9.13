<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class Life
 *
 * @property int $id
 * @property Kinsman $kinsman
 * @property string $birth_date
 * @property string $end_date
 * @property boolean $active
 * @property City $native
 *
 * @package App\Models
 */
class Life extends Model
{
    use HasFactory, Searchable, SoftDeletes, AsSource, Filterable;

    protected $table = 'life';

    protected $fillable = [
        'kinsman_id',
        'birth_date',
        'end_date',
        'active',
        'native_city_id',
    ];

    protected $allowedFilters = [
        'kinsman_id',
        'birth_date',
        'end_date',
        'active',
        'native_city_id',
    ];

    protected $allowedSorts = [
        'kinsman_id',
        'birth_date',
        'end_date',
        'active',
        'native_city_id',
    ];

//====================== relations =====================================
    public function kinsman(): BelongsTo
    {
        return $this->belongsTo(Kinsman::class);
    }

    public function native(): BelongsTo
    {
        return $this->belongsTo(City::class, 'life_native_city_id_foreign', 'native_city_id', 'nativeCityToLife');
    }

    public function city(): HasMany
    {
        return $this->hasMany(City::class, 'life_id', 'id');
    }
// ============================= end relations ===================================
}
