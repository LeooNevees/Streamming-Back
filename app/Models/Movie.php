<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movie';
    protected $fillable = [
        'title',
        'description',
        'duration',
        'age_classification',
        'year_entry',
        'genre_id',
        'type_entertainment_id',
        'created_user_id',
        'situation',
    ];
}
