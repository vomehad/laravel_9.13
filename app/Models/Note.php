<?php

namespace App\Models;

use App\Orchid\Presenters\NotePresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class Note
 * @package App\Models
 *
 * @property int            $id
 * @property string         $name
 * @property string         $content
 * @property Note           $parentNote
 * @property Category       $category
 * @property bool           $active
 * @property string         $updated_at
 *
 * @method static find(int $id)
 */
class Note extends Model
{
    use HasFactory, Searchable, SoftDeletes, AsSource, Filterable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'content',
        'active',
    ];

    protected $allowedFilters = [
        'name',
        'content',
        'active',
        'updated_at',
    ];

    protected $allowedSorts = [
        'name',
        'content',
        'active',
        'updated_at',
    ];

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function parentNote(): BelongsTo
    {
        return $this->belongsTo(Note::class, 'parent_id', 'id')->withDefault([
            'active' => true,
            'parent_id' => null
        ]);
    }

    public function presenter(): NotePresenter
    {
        return new NotePresenter($this);
    }
}
