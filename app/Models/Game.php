<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

/**
 * Class Game
 *
 * @package App\Models
 */
class Game extends Model
{
    use HasFactory, Searchable, SoftDeletes;
}
