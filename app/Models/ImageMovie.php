<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageMovie extends Model
{
    use HasFactory;
    protected $table = 'image_movie';
    protected $fillable = [
        'path_image',
        'movie_id',
        'situation',
    ];
}
