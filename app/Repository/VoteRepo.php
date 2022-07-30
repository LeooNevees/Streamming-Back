<?php

namespace App\Repository;

use App\Models\Vote;

class VoteRepo
{
    public static function create(array $params): mixed
    {
        return Vote::create([
            'users_id' => $params['users_id'],
            'movie_id' => $params['movie_id'],
            'situation' => 'A',
        ]);
    }
}
