<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property int            $id
 * @property string         $title
 * @property string         $link
 * @property string         $text
 * @property string         $preview
 * @property string         $disk
 * @property Category[]     $category
 * @property User           $author
 * @property string         $created_at
 * @property string         $updated_at
 * @property boolean        $active
 *
 * @method static find(string $column)
 */
class Article extends Model
{
    use HasFactory, Searchable, SoftDeletes, AsSource, Filterable;

    protected $fillable = [
        'title',
        'link',
        'text',
    ];

    protected $allowedFilters = [
        'title',
        'active',
        'author',
        'created_at',
        'updated_at',
    ];

    protected $allowedSorts = [
        'title',
        'active',
        'author',
        'created_at',
        'updated_at',
    ];

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

//    public function tags(): MorphToMany
//    {
//        return $this->morphToMany(Tag::class, 'taggable');
//    }
}
