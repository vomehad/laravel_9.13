<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class Category
 * @package App\Models
 *
 * @property int    $id
 * @property string $name
 * @property string $content
 * @property bool   $active
 *
 */
class Category extends Model
{
    use HasFactory, Searchable, SoftDeletes, AsSource, Filterable;

    protected $allowedFilters = [
        'name',
        'active',
        'created_at',
        'updated_at',
    ];

    protected $allowedSorts = [
        'name',
        'active',
        'created_at',
        'updated_at',
    ];

    public function article(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }

    public function note(): BelongsToMany
    {
        return $this->belongsToMany(Note::class);
    }
}
