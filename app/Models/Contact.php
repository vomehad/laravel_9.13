<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

/**
 * Class Contact
 * @package App\Models
 *
 * @property string $username
 * @property string $email
 * @property string $subject
 * @property string $message
 */
class Contact extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    /**
     * The attributes that are mass assignable
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'subject',
        'message',
    ];

    /**
     * The attributes that should be hidden for serialization
     *
     * @var array<string, int>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast
     *
     * @var array<string, int>
     */
    protected $casts = [];
}
