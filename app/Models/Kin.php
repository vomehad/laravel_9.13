<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class Kin
 *
 * @property int        $id
 * @property string     $name
 * @property string     $slug
 * @property int        $generation
 * @property int        $created_by
 * @property bool       $active
 * @property string     $color
 * @property string     $created_at
 * @property string     $updated_at
 * @property string     $deleted_at
 *
 * @package App\Models
 */
class Kin extends Model
{
    use HasFactory, Searchable, SoftDeletes, AsSource, Filterable;

    protected $table = 'kins';

    protected $fillable = [
        'name',
        'slug',
    ];

    protected $allowedFilters = [
        'name',
        'slug',
        'updated_at',
    ];

    protected $allowedSorts = [
        'name',
        'slug',
        'updated_at',
    ];

    public function kinsman(): HasMany
    {
        return $this->HasMany(Kinsman::class);
    }
}
