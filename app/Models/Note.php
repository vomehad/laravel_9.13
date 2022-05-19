<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

/**
 * Class Note
 * @package App\Models
 *
 * @property int        $id
 * @property string     $name
 * @property string     $content
 * @property string     $updated_at
 *
 * @method static find(int $id)
 */
class Note extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    /**
     * @var string[]
     */
    public $fillable = [
        'name',
        'content',
    ];

    /**
     * @return HasMany
     */
    public function category(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
