<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $table = 'vote';
    protected $fillable = [
        'title',
        'description',
        'users_id',
        'movie_id',
        'situation',
    ];
}
