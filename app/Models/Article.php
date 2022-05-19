<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

/**
 * @property int $id
 * @property string $title
 * @property string $link
 * @property string $text
 * @property string $preview
 * @property string $created_by
 * @property string $disk
 * @property string $category
 * @property string $updated_at
 *
 * @method static find(string $column)
 */
class Article extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    protected $fillable = [
        'title',
        'link',
        'text',
    ];

    public function getPreview(int $long = 512): string
    {
        $pattern = '/\.([^.]*)$/';
        $previewText = mb_substr(strip_tags($this->text), 0, $long);

        return preg_replace($pattern, '.', $previewText);
    }

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
