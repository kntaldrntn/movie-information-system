<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';

    protected $fillable = [
        'title',
        'slug',
        'synopsis',
        'genre',
        'director',
        'release_date',
        'rating',
        'duration_minutes',
        'poster_image'
    ];
}
