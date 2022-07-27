<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEntertainment extends Model
{
    use HasFactory;

    protected $table = 'type_entertainment';
    protected $fillable = [
        'name',
        'description',
        'created_user_id',
        'situation',
    ];
}
