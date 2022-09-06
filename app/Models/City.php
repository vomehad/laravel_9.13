<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class City extends Model
{
    use HasFactory, Searchable, SoftDeletes, AsSource, Filterable;

    protected $fillable = [
        'name',
        'country',
        'modern_name',
        'is_native',
        'start_date',
        'end_date',
        'geo',
        'active',
    ];

    protected $allowedFilters = [
        'name',
        'country',
        'modern_name',
        'is_native',
        'start_date',
        'end_date',
        'geo',
        'active',
    ];

    protected $allowedSorts = [
        'name',
        'country',
        'modern_name',
        'is_native',
        'start_date',
        'end_date',
        'geo',
        'active',
    ];

//====================== relations =====================================
    public function nativeCityToLife(): HasMany
    {
        return $this->hasMany(Life::class, 'native_city_id', 'id');
    }

    public function city(): HasMany
    {
        return $this->hasMany(Life::class, 'city_id', 'id');
    }
// ============================= end relations ===================================
}
